<?php 


const FLASH = 'flash_message';

const FLASH_SUCCESS = 'success';
const FLASH_INFO = 'info';
const FLASH_WARNING = 'warning';
const FLASH_ERROR = 'error';


function createFlash ($name, $msg, $type) { 

    if(isset($_SESSION[FLASH][$name])){
        unset($_SESSION[FLASH][$name]);
    }

    $_SESSION[FLASH][$name] = ['message' =>  $msg, 'type' => $type];

}


function formatMsg(array $flash_msg): string {
    return sprintf('<div class="alert alert-%s">%s</div>', 
        $flash_msg['type'],
        $flash_msg['message']
        );
}

function display_flash(string $name): void {
    if (!isset($_SESSION[FLASH][$name])) {
        return;
    }

    $flash_msg = $_SESSION[FLASH][$name];

    unset($_SESSION[FLASH][$name]);

    echo formatMsg($flash_msg);
}

function flash(string $name='', string $msg='', string $flashType=''): void {
    if ($name !== '' && $msg !== '' && $flashType !== '') {
        createFlash($name, $msg, $flashType);
    } else {
        display_flash($name);
    }
}





?>




