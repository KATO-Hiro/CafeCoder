<!doctype html>
<html lang="ja">
<?php
if (strcmp($_SERVER['SERVER_NAME'], "localhost") == 0) {
    $address = "http://localhost";
} else {
    $address = "https://www.kakecoder.com";
}
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.kakecoder.com/css/index.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144747694-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-144747694-2');
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>CafeCoder - TOP</title>

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@earlgray283_C" />
    <meta property="og:url" content="https://www.kakecoder.com" />
    <meta property="og:title" content="KakeCoder" />
    <meta property=" og:description" content="喫茶店的プログラミングコンテストサイトです。" />
    <meta property="og:image" content="https://2.bp.blogspot.com/-2PgVP0iOkHY/USNoKzJtQlI/AAAAAAAANSI/1xMd2jtWmPA/s1600/cafe_tea.png" />

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
        <div class="navbar-nav" class="username">
            <span class="nav-item">
                <?php
                if ($_SESSION["username"] != "") {
                    echo '<a style="background-color:white">' . $_SESSION["username"] . '</a>';
                    echo '<a href="' . $address . '/' . $_SESSION["username"] . '/.php">サインアウト</a>';
                } else {
                    echo '<a href="' . $address . '/signin.html">サインイン</a>';
                }
                ?>
            </span>
        </div>
    </nav>
    <br>


    <!--メインコンテンツ-->
    <div class="container">
        <div class="card" style="width:auto">
            <div class="card-body">
                <h3 class="card-title" style="background-color:">CafeCoderへようこそ！</h3>
                <hr>
                <p class="card-text">
                    　CafeCoderは喫茶店的プログラミングコンテストサイトという位置づけで運営されています。<br>
                    　喫茶店らしくまったりとした雰囲気のコンテストを定期的に開催しているのでお気軽にご参加ください。<br>

                    <h5>CafeCoderのソースコード</h5>
                    　<a href="https://github.com/earlgray283/CafeCoder">https://github.com/earlgray283/CafeCoder</a>
                    <br>


            </div>
        </div>
    </div>
    <br />

    <div class="container">
        <div class="card" style="width:auto">
            <div class="card-body">
                <h4 class="card-title">【Tea Break 002　告知】</h4>
                <h6 class="card-subtitle mb-2 text-muted">コンテスト区分：tea</h6>
                <p class="card-text">
                    ・コンテストリンク：
                    <?php
                    echo '<a href="' . $address . '/tea002/">' . $address .
                        '/tea002/</a>';
                    ?>
                    <br> ・開催時刻：2019-11-13(水) 21:00:00
                    <br> ・コンテスト時間：90分
                    <br> ・問題数：4問
                    <br> ・Writer(敬称略)：<span class="Ultraviolettwriter">Ultraviolett</span> ,otamay ,sakaki_tohru
                    <br> ・ペナルティ：3分
                    <br> ・メニュー：Green-Ceylon-Earlgray-Keemun
                </p>
                KakeCoderが帰ってきた！豪華作問メンバーと強化された採点システム、ちょっとだけ強くなったセキュリティでコンテストをお届けします。参加登録、特設ページを近日公開！<br />
            </div>
        </div>
    </div>
    <br />

    <div class="container">
        <div class="card" style="width:auto">
            <div class="card-body">
                <h4 class="card-title">【Tea Break 001　告知】</h4>
                <h6 class="card-subtitle mb-2 text-muted">コンテスト区分：tea</h6>
                <p class="card-text">
                    <?php
                    echo '<a href="' . $address . '/tea001/index.html">' . $address .
                        '/tea001/index.html</a>';
                    ?>
                    <br> ・開催時刻：2019-11-06(水) 20:00:00
                    <br> ・コンテスト時間：90分
                    <br> ・問題数：3問
                    <br> ・Writer：earlgray283
                    <br> ・ペナルティ：3分
                    <br> ・メニュー：Ceylon-Darjeeling-Earlgray
                </p>
                KakeCoderの新たな試みです。詳しくは<s>コンテストリンクへ飛んでください。</s><b>現在ページリニューアルのため過去のコンテンツが参照できません。申し訳ございませんが提出コードなどの確認は今しばらくお待ちください。</b><br>
            </div>
        </div>
    </div>
    <br />


</body>

</html>