<?php
  class ScrapBCA {
    private $ipaddress;
    private $user = 'user klik bca';
    private $pass = 'pass klik bca';
    private $bca_url = 'https://ibank.klikbca.com/';
    private $bca_url_login = 'https://ibank.klikbca.com/authentication.do';
    private $bca_url_menu = 'https://ibank.klikbca.com/nav_bar_indo/menu_bar.htm';

    public function __construct() {
      $this->ipaddress = getenv("REMOTE_ADDR");
    }

    public function start() {
      $result_open = $this->get_page_no_cookie('https://ibank.klikbca.com/');
      $ketemu = true;
      $cookie_1;
      $cookie_2;
      
      if (preg_match('/JSESSIONID=(.*?);/', $result_open, $result)) {
        $cookie_1 = $result[1];
        file_put_contents('log_bca.txt', date('Y-m-d H:i') ." : ". 'JSESSIONID=' . $cookie_1, FILE_APPEND);
        file_put_contents('result_open.html', $result_open);
      } else {
        $ketemu = false;
        file_put_contents('log_bca.txt', date('Y-m-d H:i') ." : ". 'COOKIE NOT FOUND', FILE_APPEND);
        file_put_contents('result_open.html', $result_open);
      }

      if (preg_match('/ARPT=(.*?);/', $result_open, $result2)) {
        $cookie_2 = $result2[1];
        file_put_contents('log_bca.txt', "\r\n". "\r\n" . date('Y-m-d H:i') ." : ". 'ARPT=' . $cookie_2, FILE_APPEND);
      } else {
        $ketemu = false;
        file_put_contents('log_bca.txt', date('Y-m-d H:i') ." : ". 'COOKIE2 NOT FOUND', FILE_APPEND);
      }

      $data_return['cookie_1'] = $cookie_1;
      $data_return['cookie_2'] = $cookie_2;
      $data_return['ketemu'] = $ketemu;

      return $data_return;
    }

    private function get_page_no_cookie($url) {
      $c = curl_init();
      curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($c, CURLOPT_AUTOREFERER, 1);
      curl_setopt($c, CURLOPT_HTTPGET, 1);
      curl_setopt($c, CURLINFO_HEADER_OUT,1);
      curl_setopt($c, CURLOPT_VERBOSE, 1); 
      curl_setopt($c, CURLOPT_HEADER, 1); 
      curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
      curl_setopt($c, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
      curl_setopt($c, CURLOPT_URL, $url);
      $page = curl_exec($c);
      curl_close($c);
      return $page;
    }

    public function login($cookie_1, $cookie_2) {
      file_put_contents('log_bca.txt',  "\r\n" . date('Y-m-d H:i').' : IP Address=' . $this->ipaddress, FILE_APPEND);
      $fields = "value%28actions%29=login&value%28user_id%29=$this->user&value%28user_ip%29=$this->ipaddress&value%28pswd%29=$this->pass&value%28Submit%29=LOGIN";
      $page_login = $this->post_to_page($this->bca_url_login, $this->bca_url, $cookie_1, $cookie_2, $fields);
      file_put_contents('page_login.html', $page_login);
      $is_login = false;
      if (strpos($page_login, "value(actions)=logout")) {
        $is_login = true;
      }
      return $is_login;   
    }

    private function post_to_page($url, $referer=null, $cookie=null, $cookie2, $postfields=null) {
        $c = curl_init();
      curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($c, CURLINFO_HEADER_OUT, true);
      curl_setopt($c, CURLOPT_VERBOSE, true); 
      curl_setopt($c, CURLOPT_HEADER, true); 
      curl_setopt($c, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true); 
      curl_setopt($c, CURLOPT_MAXREDIRS, 5);
      if ($cookie) curl_setopt($c, CURLOPT_COOKIE, "ARPT=$cookie2; JSESSIONID=$cookie"); 
      if ($referer) curl_setopt($c, CURLOPT_REFERER, $referer);
      curl_setopt($c, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
      curl_setopt($c, CURLOPT_URL, $url);
      curl_setopt($c, CURLOPT_POST, 1);
      if ($postfields) curl_setopt($c, CURLOPT_POSTFIELDS, $postfields);
      $page = curl_exec($c);
      curl_close($c);
      return $page;
    }

    public function show_menu($cookie_1, $cookie_2) {
      $c = curl_init();
      curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);   
      curl_setopt($c, CURLOPT_COOKIE, "ARPT=$cookie_2; JSESSIONID=$cookie_1"); 
      curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($c, CURLOPT_VERBOSE, true);
      curl_setopt($c, CURLOPT_HEADER, true);
      curl_setopt($c, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
      curl_setopt($c, CURLOPT_URL, $this->bca_url_menu); 
      curl_setopt($c, CURLOPT_REFERER, $this->bca_url_login);
      curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
      $page_show_menu = curl_exec($c);
      file_put_contents('page_show_menu.html', $page_show_menu);
      $referer = 'https://ibank.klikbca.com/authentication.do?value(actions)=welcome';
      $fields = 'value%28actions%29=selecttransaction'; 
      $page_result_menu = $this->post_to_page($this->bca_url_login, $referer, $cookie_1, $cookie_2, $fields);
      file_put_contents('page_result_menu.html', $page_result_menu);
    }

    public function info_rekening($cookie_1, $cookie_2) {
      $url = 'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm';
        $page_info_rekening = $this->get_page_cookie($url,$cookie_1,$cookie_2,$this->bca_url_login);
        file_put_contents('page_info_rekening.html', $page_info_rekening);
    }

    private function get_page_cookie($url, $cookie_1=null, $cookie_2=null, $referer=null) {
      $c = curl_init();
      curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);   
      curl_setopt($c, CURLOPT_COOKIE, "ARPT=$cookie_2; JSESSIONID=$cookie_1"); 
      curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($c, CURLOPT_HEADER, true);
      curl_setopt($c, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);  
      curl_setopt($c, CURLOPT_URL, $url); 
      curl_setopt($c, CURLOPT_REFERER, $referer);
      curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($c, CURLOPT_HTTPGET, true);
      $page = curl_exec($c);
      curl_close($c);
      return $page;
    }

    public function show_mutasi($cookie_1,$cookie_2) {
      $url = 'https://ibank.klikbca.com/accountstmt.do';
        $referer = 'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm';
        $fields = "value%28actions%29=acct_stmt";
        $mutasi = $this->post_to_page($url, $referer, $cookie_1, $cookie_2, $fields);
        file_put_contents('mutasi.html', $mutasi);
    }

    public function show_last_mutasi($cookie_1,$cookie_2) {
      $tgl2 = mktime(0,0,0,date("n"),date("d"),date("Y"));
      $tgl1 = mktime(0,0,0,date("n"),date("d")-31,date("Y"));
      
      file_put_contents('log_bca.txt',  "\r\n" . date('Y-m-d H:i')." : tgl1=$tgl1 ," .date("Y-m-d", $tgl1) , FILE_APPEND);
      file_put_contents('log_bca.txt',  "\r\n" . date('Y-m-d H:i')." : tgl2=$tgl2 ," .date("Y-m-d", $tgl2) , FILE_APPEND);

        $url = 'https://ibank.klikbca.com/accountstmt.do?value(actions)=acctstmtview';
        $referer = 'https://ibank.klikbca.com/accountstmt.do?value(actions)=acct_stmt';
      
        $fields = array(
          'value(D1)'=>'0',
        'value(endDt)'=> date("d", $tgl2),
        'value(endMt)'=> date("n", $tgl2),
        'value(endYr)'=> date("Y", $tgl2),
        'value(fDt)'=>'',
        'value(r1)'=>'1',
        'value(startDt)'=> date("d", $tgl1),
        'value(startMt)'=> date("n", $tgl1),
        'value(startYr)'=> date("Y", $tgl1),
        'value(submit1)'=>'Lihat Mutasi Rekening',
        'value(tDt)'=>''
      );
      
      $page_mutasi = $this->post_to_page($url, $referer, $cookie_1, $cookie_2, $fields);
      file_put_contents('page_mutasi.html', $page_mutasi);
    }

    public function logout($cookie_1, $cookie_2) {
      $fields = "value%28actions%29=logout";
        $referer = 'https://ibank.klikbca.com/top.htm';
        $page_logout = $this->post_to_page($this->bca_url_login, $referer, $cookie_1, $cookie_2, $fields);
        file_put_contents('page_logout.html', $page_logout);
    }
  }
?>