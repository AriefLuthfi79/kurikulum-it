<?php

class Config
{
    public function connect()
    {
        // mysqli_connect() function opens a new connection to the MySQL server. 
        $con = mysqli_connect('localhost', 'root', 'root', 'Kurikulum_otentikasi');

        return $con;
    }
}
