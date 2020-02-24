<?php $currentPage = basename($_SERVER["SCRIPT_FILENAME"], '.php')?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocGo - Document Sharing Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="resources/css/header.css">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans&display=swap" rel="stylesheet">
    <link href="resources/icons/document.svg" rel="icon"  type="image/x-icon" />
    <link href="resources/icons/document.png" rel="icon"  type="image/x-icon" />
    <?php if($currentPage  == 'index'){echo '<link rel="stylesheet" href="resources/css/index.css">';} ?>
    <?php if($currentPage == 'register' || $currentPage == 'login'){echo '<link rel="stylesheet" href="resources/css/login.css">';} ?>
</head>

<body>
    
<header>
    <nav>
    <a href="index"><span><svg id="logo_icon" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <polygon style="fill:#E7E7E7;" points="466,150 466,512 46,512 46,0 316,0 335.799,55.199 355.3,110.7 410.799,130.199 "/> <polygon style="fill:#D3D3D8;" points="466,150 466,512 256,512 256,0 316,0 335.799,55.199 355.3,110.7 410.799,130.199 "/> <rect x="346" y="390" style="fill:#BABAC0;" width="30" height="30"/> <g> <rect x="136" y="120" style="fill:#D3D3D8;" width="120" height="30"/> <rect x="136" y="210" style="fill:#D3D3D8;" width="240" height="30"/> <rect x="136" y="300" style="fill:#D3D3D8;" width="240" height="30"/> <rect x="136" y="390" style="fill:#D3D3D8;" width="180" height="30"/> </g> <g> <polygon style="fill:#BABAC0;" points="316,150 466,150 316,0 	"/> <rect x="256" y="390" style="fill:#BABAC0;" width="60" height="30"/> <rect x="256" y="210" style="fill:#BABAC0;" width="120" height="30"/> <rect x="256" y="300" style="fill:#BABAC0;" width="120" height="30"/> </g></svg></span>
    <span id="logo_text">Doc<span id="logo_text_accent">Go</span></span></span></a>
   
        <ul>
            <li><a class="<?php if($currentPage == 'index'){echo 'active';}else{echo 'unactive';}?>" href="#">Home</a></li>
            <li><a class="<?php if($currentPage == 'about'){echo 'active';}else{echo 'unactive';}?>" href="#">About</a></li>
            <li><a class="<?php if($currentPage == 'contact'){echo 'active';}else{echo 'unactive';}?>" href="#">Contact us</a></li>
        </ul>
            <?php 
                if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'index'){
                    echo '
                    <div id="user_logo">
                        <img style="width:100%;" src="resources/icons/user.png"/>
                    </div>';
                }
           ?>
    </nav>

</header>