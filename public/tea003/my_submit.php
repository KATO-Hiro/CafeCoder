<!DOCTYPE HTML>
<html lang="ja">
<?php
if (strcmp($_SERVER['SERVER_NAME'], "localhost") == 0) {
    $address = "http://localhost";
} else {
    $address = "https://www.kakecoder.com";
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>提出結果</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.css" />
    <script src="https://cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.js"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script>
        jQuery(function($) {
            $.extend($.fn.dataTable.defaults, {
                language: {
                    url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
                }
            });
            $("#result-table").DataTable({
                order: [
                    [0, "desc"]
                ]
            });
        });
    </script>
    <style>
        .AC {
            color: palegreen;
        }

        .WA {
            color: orange;
        }

        .TLE {
            color: orange;
        }

        .RE {
            color: orange;
        }

        .MLE {
            color: orange;
        }

        .CE {
            color: lightblue;
        }

        .IE {
            color: lightblue;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark " style="background-color:#a0522d;">
    <?php
        echo '<a href="' . $address . '/" class="navbar-brand">CafeCoder</a>';
        ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu1">
            <div class="navbar-nav">
                <?php
                echo '<a class="nav-item nav-link" href="' . $address . '/">ホーム</a>';
                echo '<a class="nav-item nav-link" href="' . $address . '/Contest.html">コンテスト一覧</a>';
                ?>
            </div>
        </div>
    </nav>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <div class="container">
        <div class="card" style="width: auto">
            <div class="card-body">
                <nav class="navbar navbar-expand-sm navbar-light bg-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu1">
                        <div class="navbar-nav">
                            <?php
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea003">コンテストTOP</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea003/problem_list.php">問題一覧</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea003/ranking.php">ランキング</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea003/my_submit.php">自分の提出</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea003/all_submit.php">みんなの提出</a>';
                            ?>
                        </div>
                    </div>
                </nav>

                <?php
                $username = $_SESSION["username"];
                $problem = $_SESSION["problem"];
                $code_session = $_SESSION["code_session"];

                $user_code = file_get_contents($_SESSION["code_path"]);
                $user_code = explode("\n", $user_code);

                $cnt = 0;
                $result_path = "/var/www/html/public/users/$username/codes/$problem/$code_session" . ".result";
                $file = new SplFileObject($result_path);
                $file->setFlags(SplFileObject::READ_CSV);

                $testcase_list_path = "/var/www/html/Contests/tea003/" . $problem . "/testcase_list.txt";
                $inn = file_get_contents($testcase_list_path);
                $inn = explode("\n", $inn);

                foreach ($file as $outputs) {
                    echo '<pre class="prettyprint">';
                    for ($i = 0; $i < count($user_code); $i++) {
                        echo htmlspecialchars($user_code[$i]);
                        echo '<br>';
                    }
                    echo '</pre>';

                    echo '<table class="table table-bordered">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>テストケース</th>';
                    echo '<th>結果</th>';
                    echo '<th>実行時間</th>';
                    echo '</tr>';
                    echo '</thead>';

                    echo '<tbody>';

                    $start = 5;
                    $end = count($outputs);
                    for ($i = $start; $i <= $end - 2; $i += 2) {
                        $case_number = intdiv(($i - 4), 2);
                        $tim = $outputs[$i + 1];
                        echo '<tr>';
                        echo '<th>' . $inn[$case_number] . '</th>';
                        echo '<th><span class="' . $outputs[$i] . '">' . $outputs[$i] . '</span></th>';
                        echo '<th>' . $tim . '[ms]</th>';
                    }
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';


                    echo '<table class="table table-bordered">';
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<th>ユーザID</th>';
                    echo '<th>' . $username . '</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>問題</th>';
                    echo '<th>' . $problem . '</                // var_dump($file);th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>結果</th>';
                    echo '<th>' . $outputs[3] . '</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>実行時間</th>';
                    echo '<th>' . $outputs[1] . ' [ms]</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>メモリ使用量</th>';
                    echo '<th>' . $outputs[2] . ' [kB]</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>得点</th>';
                    echo '<th>' . $outputs[4] . '</th>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                }
                ?>
            </div>
        </div>
    </div>
</body>