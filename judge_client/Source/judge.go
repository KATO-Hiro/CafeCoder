package main

import (
	"net"
	"fmt"
	"os"
)

const (
	BACK_HOST_PORT = "localhost:4649"
)

func main () {
	payload := ""
	for _, arg := range os.Args {
		payload += arg + ","
	}
	passJobToBack(payload)
	
}

func passJobToBack(arg string){
	conn , err := net.Dial("tcp", BACK_HOST_PORT)
	if err != nil {
		fmt.Println(err)
		return
	}
	conn.Write([]byte(arg + "\n"))
	conn.Close()
}
