<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is the activity for Money Button Game">
    <title>Money Button Game</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: courier;
        }
        form{
            display: block;
            width: 900px;
            margin: 50px auto 0 auto;
        }
            form p,
            form div,
            form input{
                display: inline-block;
                width: fit-content;
            }
            form p#money{
                width: 773px;
                font-size: 20px;
                font-weight: bold;
            }
            form p.wide{
                width: 100%;
                font-size: 20px;
                margin-bottom: 30px;
            }
            form div{
                width: 210px;
                text-align: center;
                padding: 20px 0;
                margin-right: 14px;
                border: solid 2px black;
                vertical-align: top;
                max-height: 120px;
                margin-bottom: 50px;
            }
            form div#severe{
                margin-right: 0;
            }
                form div p,
                form div input{
                    margin-bottom: 20px;
                }
                form div p{
                    display:block;
                    text-align: center;
                    width: 100%;
                }
            form div#message{
                width: 100%;
                height: 150px;
                overflow: hidden auto;
                overflow-anchor: auto;
                padding: 0;
            }
                form div#message p{
                    text-align: left;
                    margin-bottom: 10px;
                }
                form div#message p.success{
                    color: lightgreen;
                }
                form div#message p.danger{
                    color: red;
                }
            form input{
                padding: 10px 20px;
                background-color: lightgreen;
                max-width: 60px;
                box-shadow: 3px 3px 0px black;
                font-weight: bold;
                cursor: pointer;
            }
            form input#reset{
                max-width: 150px;
                background-color: darkred;
                color: white;
            }
    </style>
</head>
<body>
    <form action="reset"><!--
        --><p id="money">Your Money: <?= $this->session->userdata('money') ?></p><!--
        --><input type="submit" name="reset" value="Reset Game" id="reset"><!--
        --><p class="wide">Chances left: <?= $this->session->userdata('chances') ?></p><!--
--></form>
    <form action="bet" method="post"><div><!--
            --><p>Low Risk</p><!--
            --><input type="submit" name="bet" value="low"><!--
            --><p>by -25 up to 100</p><!--
        --></div><!--
        --><div><!--
            --><p>Moderate Risk</p><!--
            --><input type="submit" name="bet" value="moderate"><!--
            --><p>by -100 up to 1000</p><!--
        --></div><!--
        --><div><!--
            --><p>High Risk</p><!--
            --><input type="submit" name="bet" value="high"><!--
            --><p>by -500 up to 2500</p><!--
        --></div><!--
        --><div id="severe"><!--
            --><p>Severe Risk</p><!--
            --><input type="submit" name="bet" value="severe"><!--
            --><p>by -3000 up to 5000</p><!--
        --></div><!--
        --><p class="wide">Game Host:</p><!--
        --><div id="message"><!--
            -->
<?php
                $messages = $this->session->userdata('messages');
                if(!empty($messages))
                {
                    foreach($messages as $message)
                    {
?>
                <p><?= $message ?></p>
<?php
                    }  
                }
?>
            <!--
        --></div><!--
    --></form>
</body>
</html>