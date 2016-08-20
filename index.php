<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        
        
        
        
        
        /*custom font*/
@import url(http://fonts.googleapis.com/css?family=Montserrat);

/*basic reset*/
* {margin: 0; padding: 0;}

/*html {
	height: 100%;
	/*Image only BG fallback*/
	background: url('http://thecodeplayer.com/uploads/media/gs.png');
	/*background = gradient + image pattern combo*/
	background: 
		linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), 
		url('http://thecodeplayer.com/uploads/media/gs.png');
}*/
        .tab-pane{
            margin-left: auto;
            margin: 0 auto;
            margin-right: auto;
        }
body {
	font-family: montserrat, arial, verdana;
    font-size: 20;
}
/*form styles*/
#msform {
	width: 90%;
	margin: 50px auto;
	text-align: center;
	position: relative;
}
#msform fieldset {
	background: white;
	border: 0 none;
	border-radius: 3px;
	box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
	padding: 20px 30px;
	
	box-sizing: border-box;
	width: 80%;
	margin: 0 10%;
	
	/*stacking fieldsets above each other*/
	position: absolute;
}
/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
	display: none;
}
/*inputs*/
#msform input, #msform textarea {
	padding: 15px;
	border: 1px solid #ccc;
	border-radius: 3px;
	margin-bottom: 10px;
	width: 100%;
	box-sizing: border-box;
	font-family: montserrat;
	color: #2C3E50;
	font-size: 13px;
}
/*buttons*/
#msform .action-button {
	width: 100px;
	background: #27AE60;
	font-weight: bold;
	color: white;
	border: 0 none;
	border-radius: 1px;
	cursor: pointer;
	padding: 10px 5px;
	margin: 10px 5px;
}
#msform .action-button:hover, #msform .action-button:focus {
	box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
}
/*headings*/
.fs-title {
	font-size: 15px;
	text-transform: uppercase;
	color: #2C3E50;
	margin-bottom: 10px;
}
.fs-subtitle {
	font-weight: normal;
	font-size: 13px;
	color: #666;
	margin-bottom: 20px;
}
/*progressbar*/
#progressbar {
	margin-bottom: 30px;
	overflow: hidden;
	/*CSS counters to number the steps*/
	counter-reset: step;
}
#progressbar li {
	list-style-type: none;
	color: black;
	text-transform: uppercase;
	font-size: 9px;
	width: 33.33%;
	float: left;
	position: relative;
}
#progressbar li:before {
	content: counter(step);
	counter-increment: step;
	width: 20px;
	line-height: 20px;
	display: block;
	font-size: 10px;
	color: #333;
	background: white;
	border-radius: 3px;
	margin: 0 auto 5px auto;
}
/*progressbar connectors*/
#progressbar li:after {
	content: '';
	width: 100%;
	height: 2px;
	background: gray;
	position: absolute;
	left: -50%;
	top: 9px;
	z-index: -1; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
	/*connector not needed before the first step*/
	content: none; 
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
	background: #27AE60;
	color: white;
}





        
        
        
        
        
        
        h2.funcTitle
        {
            padding-left: 150px;
            color: #3278b3;
        }
        .form-inline .form-control {
            display: inline-block;
            width: auto;
            vertical-align: middle;
        }
    </style>
    <title> SHOF-J - Cryptography Made Easy</title>
    <script src="js/DES.js"></script>
    <script src="js/rc4.js"></script>
    <script src="js/permutation.js"></script>
    <script src="js/playfair.js"></script>
   
    <script type="text/javascript">
        "use strict";
        function caesarCrypt(isDecrypt) {
            var shiftText = document.getElementById("shift").value;
            if (!/^-?\d+$/.test(shiftText)) {
                alert("Shift Value is not an Integer");
                return;
            }
            var key = parseInt(shiftText, 10);
            if (key < 0 || key >= 26) {
                alert("Shift Value is Out of Range");
                return;
            }
            if (isDecrypt)
                key = (26 - key) % 26;
            var textElem = document.getElementById("caesartext");
            textElem.value = caesar(textElem.value, key);
        }
        function caesar(input, key) {
            var output = "";
            for (var i = 0; i < input.length; i++) {
                var c = input.charCodeAt(i);
                if (c >= 65 && c <= 90) output += String.fromCharCode((c - 65 + key) % 26 + 65);  // Uppercase
                else if (c >= 97 && c <= 122) output += String.fromCharCode((c - 97 + key) % 26 + 97);  // Lowercase
                else output += input.charAt(i);  // Copy
            }
            return output;
        }

        function vigenereCrypt(isDecrypt) {
            if (document.getElementById("vigenerekey").value.length == 0) {
                alert("Key Value is Not Available.");
                return;
            }
            if (!/^[a-zA-Z]+$/.test(document.getElementById("vigenerekey").value)) {
                alert("Key is not a letter");
                return;
            }
            var key = filterKey(document.getElementById("vigenerekey").value);
            if (key.length == 0) {
                alert("Key Length = 0");
                return;
            }
            if (isDecrypt) {
                for (var i = 0; i < key.length; i++)
                    key[i] = (26 - key[i]) % 26;
            }
            var textElem = document.getElementById("vigeneretext");
            textElem.value = vigenere(textElem.value, key);
        }
        function vigenere(input, key) {
            var output = "";
            for (var i = 0, j = 0; i < input.length; i++) {
                var c = input.charCodeAt(i);
                if (isUppercase(c)) {
                    output += String.fromCharCode((c - 65 + key[j % key.length]) % 26 + 65);
                    j++;
                } else if (isLowercase(c)) {
                    output += String.fromCharCode((c - 97 + key[j % key.length]) % 26 + 97);
                    j++;
                } else {
                    output += input.charAt(i);
                }
            }
            return output;
        }

        function autokeyCrypt(isDecrypt) {
            if (document.getElementById("autokeykey").value.length == 0) {
                alert("Key Value is Not Available.");
                return;
            }
            if (!/^[a-zA-Z]+$/.test(document.getElementById("vigenerekey").value)) {
                alert("Key is not a letter");
                return;
            }
            var key = filterKey(document.getElementById("autokeykey").value);
            if (key.length == 0) {
                alert("Key Length = 0");
                return;
            }
            var pkey = filterKey(document.getElementById("autokeytext").value);
            if (isDecrypt) {
                for (var i = 0; i < key.length; i++)
                    key[i] = (26 - key[i]) % 26;
            }
            var textElem = document.getElementById("autokeytext");
            textElem.value = autokey(textElem.value, key, pkey, isDecrypt);
        }
        function autokey(input, key, pkey, isDecrypt) {
            var output = "";
            for (var i = 0, j = 0; i < input.length; i++) {
                var c = input.charCodeAt(i);

                if (j < key.length) {
                    if (isUppercase(c)) {
                        output += String.fromCharCode((c - 65 + key[j]) % 26 + 65);
                        j++;
                    } else if (isLowercase(c)) {
                        output += String.fromCharCode((c - 97 + key[j]) % 26 + 97);
                        j++;
                    } else {
                        output += input.charAt(i);
                    }
                } else {
                    if (isDecrypt) {
                        pkey = filterKey(output);
                        pkey[j - key.length] = (26 - pkey[j - key.length]) % 26;
                    }
                    if (isUppercase(c)) {
                        output += String.fromCharCode((c - 65 + pkey[j - key.length]) % 26 + 65);
                        j++;
                    } else if (isLowercase(c)) {
                        output += String.fromCharCode((c - 97 + pkey[j - key.length]) % 26 + 97);
                        j++;
                    } else {
                        output += input.charAt(i);
                    }
                }
            }
            return output;
        }

        function affineCrypt(isDecrypt){
            var affinekeyText = document.getElementById("affinekey").value;
            var affinekeyText2 = document.getElementById("affinekey2").value;
            if (!/^-?\d+$/.test(affinekeyText) || !/^-?\d+$/.test(affinekeyText2)) {
                alert("The key is not an integer");
                return;
            }
            var key = parseInt(affinekeyText, 10);
            if (gcd(key, 26) != 1) {
                alert("GCD of key is 26, with no prime");
                return;
            }
            var key2 = parseInt(affinekeyText2, 10);
            if (key2 < 0) {
                alert("Key can not be negative");
                return;
            }

            //EN C = key P + b % 26
            //DE P = key ^(-1) (C-b)%26

            var textElem = document.getElementById("affinetext");
            if (isDecrypt) {
                for (var i = 1; i <= 25; i = i + 2) {
                    if ((key * i) % 26 == 1) {
                        key = i;
                        break;
                    }
                }
                textElem.value = affineDe(textElem.value, key, key2);
            } else
                textElem.value = affine(textElem.value, key, key2);
        }
        function affine(input, key, key2) {
            var output = "";
            for (var i = 0; i < input.length; i++) {
                var c = input.charCodeAt(i);
                if (isUppercase(c)) {
                    output += String.fromCharCode(((c - 65) * key + key2 % 26) % 26 + 65);
                } else if (isLowercase(c)) {
                    output += String.fromCharCode(((c - 97) * key + key2 % 26) % 26 + 97);
                } else {
                    output += input.charAt(i);
                }
            }
            return output;
        }

        function affineDe(input, key, key2) {
            var output = "";
            for (var i = 0; i < input.length; i++) {
                var c = input.charCodeAt(i);
                if (isUppercase(c)) {
                    output += String.fromCharCode((key * (c - 65 - key2 + 26)) % 26 + 65);
                } else if (isLowercase(c)) {
                    output += String.fromCharCode((key * (c - 97 - key2 + 26)) % 26 + 97);
                } else {
                    output += input.charAt(i);
                }
            }
            return output;
        }

        function DESCrypt(isDecrypt) {
            if (document.getElementById("DESkey").value.length == 0) {
                alert("Key Value is empty");
                return;
            }
            if (!/^[a-zA-Z]+$/.test(document.getElementById("DESkey").value)) {
                alert("Key is not a letter");
                return;
            }
            var key = filterKey(document.getElementById("DESkey").value);
            if (key.length == 0) {
                alert("Key Length = 0");
                return;
            }
            var DESkey = document.getElementById("DESkey");
            var textElem = document.getElementById("DEStext");
            if (isDecrypt) {
                var textElem2P = CryptoJS.DES.decrypt(textElem.value, DESkey.value);
                var textElem2 = textElem2P.toString(CryptoJS.enc.Utf8);
            } else {
                var textElem2 = CryptoJS.DES.encrypt(textElem.value, DESkey.value);
            }
            textElem.value = textElem2;
        }

        function rc4Crypt(isDecrypt) {
            if (document.getElementById("rc4key").value.length == 0) {
                alert("Key Value is empty");
                return;
            }
            if (!/^[a-zA-Z]+$/.test(document.getElementById("rc4key").value)) {
                alert("Key is not a letter");
                return;
            }
            var key = filterKey(document.getElementById("rc4key").value);
            if (key.length == 0) {
                alert("Key Length = 0");
                return;
            }
            var rc4key = document.getElementById("rc4key");
            var textElem = document.getElementById("rc4text");
            if (isDecrypt) {
                var textElem2P = CryptoJS.RC4.decrypt(textElem.value, rc4key.value);
                var textElem2 = textElem2P.toString(CryptoJS.enc.Utf8);
            } else {
                var textElem2 = CryptoJS.RC4.encrypt(textElem.value, rc4key.value);
            }
            textElem.value = textElem2;
        }

        //Convert letters to array of number
        function filterKey(key) {
            var result = [];
            for (var i = 0; i < key.length; i++) {
                var c = key.charCodeAt(i);
                if (isLetter(c))
                    result.push((c - 65) % 32);
            }
            return result;
        }
        // Tests whether the specified character code is a letter.
        function isLetter(c) {
            return isUppercase(c) || isLowercase(c);
        }
        // Tests whether the specified character code is an uppercase letter.
        function isUppercase(c) {
            return c >= 65 && c <= 90;  // 65 is the character code for 'A'. 90 is for 'Z'.
        }
        // Tests whether the specified character code is a lowercase letter.
        function isLowercase(c) {
            return c >= 97 && c <= 122;  // 97 is the character code for 'a'. 122 is for 'z'.
        }
        function gcd(x, y) {
            while (y != 0) {
                var z = x % y;
                x = y;
                y = z;
            }
            return x;
        }

    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jsencrypt.js"></script>
</head>
<body style="background-color: #ededed;">

<div class="around" style="padding: 10px;">
    <ul id="Crypto" class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#localCrypto" role="tab" data-toggle="tab">TEXT ENC & DEC</a></li>
        <li class=""><a href="#DH" role="tab" data-toggle="tab">IMAGE ENC & DEC</a></li>
      
    </ul>
    <div id="CryptoContent" class="tab-content">
        <div class="tab-pane fade active in" id="localCrypto">
            <div class="blank" style="padding-top: 10px;"></div>

            <div id="selector" style="padding-left: 20px; padding-bottom: 10px; width: 150px;">
                <ul id="Algorithms" class="nav nav-pills" role="tablist">
                    <li class="dropdown active">
                        
                        <a href="#" id="SelectAlgorithms" class="dropdown-toggle" data-toggle="dropdown" style="z-index: 2"><font size="2em">Algorithms      </font><span
                                class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="selectAlgorithms">
                            <li role="presentation" class="dropdown-header">Simple Substitution</li>
                            <li class="active"><a href="#caesar" tabindex="-1" role="tab" data-toggle="tab">Caesar</a></li>
                            <li class=""><a href="#affine" tabindex="-1" role="tab" data-toggle="tab">Affine</a></li>
                            <li role="presentation" class="dropdown-header">Poly-alphabetic</li>
                            <li class=""><a href="#vigenere" tabindex="-1" role="tab" data-toggle="tab">Vigenere</a></li>
                            <li class=""><a href="#autokey" tabindex="-1" role="tab" data-toggle="tab">Autokey</a></li>
                            <li role="presentation" class="dropdown-header">Row Transposition</li>
                            <li class=""><a href="#playfair" tabindex="-1" role="tab" data-toggle="tab">Playfair</a></li>
                            <li role="presentation" class="dropdown-header">Column Transposition</li>
                            <li class=""><a href="#colpermutation" tabindex="-1" role="tab" data-toggle="tab">Column Permutation</a></li>
                            <li role="presentation" class="dropdown-header">Stream cipher</li>
                            <li class=""><a href="#rc4" tabindex="-1" role="tab" data-toggle="tab">RC4</a></li>
                            <li role="presentation" class="dropdown-header">Block cipher</li>
                            <li class=""><a href="#des" tabindex="-1" role="tab" data-toggle="tab">DES</a></li>
                            <li role="presentation" class="dropdown-header">Public-Key Cryptography</li>
                            <li class=""><a href="#rsa" tabindex="-1" role="tab" data-toggle="tab">RSA</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div id="AlgorithmsContent" class="tab-content" style="position: absolute; top: 45px; z-index: 1">
                <div class="tab-pane fade active in" id="caesar">
                    <h2 class="funcTitle">Caesar</h2>
                    <form role="form" action="#" method="get" onsubmit="return false">
                        <div class="form-group">
                            <label for="caesartext" class="control-label">Text:</label>
                            <textarea class="form-control" id="caesartext" cols="50" rows="10" style="width: 480px; height: 200px; margin: 0; resize: none;">SHOF-J</textarea>
                        </div>
                        <div class="form-group">
                            <label for="shift" class="control-label">Key:</label>
                            <input class="form-control" type="text" id="shift" value="16" style="width:4em;"/>
                        </div>
                            <input type="button" class="btn btn-success" value="Encrypt" onclick="caesarCrypt(false)"/>
                            <input type="button" class="btn btn-primary" value="Decrypt" onclick="caesarCrypt(true)"/>
                    </form>
                </div>

                <div class="tab-pane fade" id="affine">
                    <h2 class="funcTitle">Affine Cipher</h2>
                    <form role="form" action="#" method="get" onsubmit="return false">
                        <div class="form-group">
                            <label for="affinetext" class="control-label">Text:</label>
                            <textarea class="form-control" id="affinetext" cols="50" rows="10" style="width: 480px; height: 200px; margin: 0; resize: none;">Cryptography and Network Security Final Project</textarea>
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="affinekey" class="control-label" style="margin-bottom: 5px">Key:</label><br>
                                <input class="form-control" type="text" id="affinekey" value="1" style="width:4em;"/>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="affinekey2" class="control-label sr-only">Key 2:</label>
                                <input class="form-control" type="text" id="affinekey2" value="1" style="width:4em;"/>
                            </div>
                        </div>
                        <br>
                        <input type="button" class="btn btn-success" value="Encrypt" onclick="affineCrypt(false)"/>
                        <input type="button" class="btn btn-primary" value="Decrypt" onclick="affineCrypt(true)"/>
                    </form>
                </div>

                <div class="tab-pane fade" id="vigenere">
                    <h2 class="funcTitle">Vigenere</h2>
                    <form role="form" action="#" method="get" onsubmit="return false">
                        <div class="form-group">
                            <label for="vigeneretext" class="control-label">Text:</label>
                            <textarea class="form-control" id="vigeneretext" cols="50" rows="10" style="width: 480px; height: 200px; margin: 0; resize: none;">Cryptography and Network Security Final Project</textarea>
                        </div>
                        <div class="form-group">
                            <label for="vigenerekey" class="control-label">Key</label>
                            <input class="form-control" type="text" id="vigenerekey" value="abc" style="width:16em;"/>
                        </div>
                        <input type="button" class="btn btn-success" value="Encrypt" onclick="vigenereCrypt(false)"/>
                        <input type="button" class="btn btn-primary" value="Decrypt" onclick="vigenereCrypt(true)"/>
                    </form>
                </div>

                <div class="tab-pane fade" id="autokey">
                    <h2 class="funcTitle">Autokey</h2>
                    <form role="form" action="#" method="get" onsubmit="return false">
                        <div class="form-group">
                            <label for="autokeytext" class="control-label">Text:</label>
                            <textarea class="form-control" id="autokeytext" cols="50" rows="10" style="width: 480px; height: 200px; margin: 0; resize: none;">Cryptography and Network Security Final Project</textarea>
                        </div>
                        <div class="form-group">
                            <label for="autokeykey" class="control-label">Key:</label>
                            <input class="form-control" type="text" id="autokeykey" value="abc" style="width:16em;"/>
                        </div>
                        <input type="button" class="btn btn-success" value="Encrypt" onclick="autokeyCrypt(false)"/>
                        <input type="button" class="btn btn-primary" value="Decrypt" onclick="autokeyCrypt(true)"/>
                    </form>
                </div>

                <div class="tab-pane fade" id="playfair">
                    <h2 class="funcTitle">Playfair</h2>
                    <form role="form">
                        <div class="form-group">
                            <label for="playfairtext" class="control-label">Text:</label>
                            <textarea class="form-control" name="playfairtext" id="playfairtext" cols="50" rows="10" style="width: 480px; height: 200px; margin: 0; resize: none;">Cryptography and Network Security Final Project</textarea>
                        </div>
                        <div class="form-group">
                            <label for="playfairkey" class="control-label">Key:</label>
                            <input class="form-control" type="text" id="playfairkey" name="playfairkey" value="playfair" style="width:16em;"/>
                        </div>
                        <input type="button" class="btn btn-success" value="Encrypt" onclick="Playfair(playfairtext, playfairkey, m11, m12, m13, m14, m15, m21, m22, m23, m24, m25, m31, m32, m33, m34, m35, m41, m42, m43, m44, m45, m51, m52, m53, m54, m55)"/>
                        <input type="button" class="btn btn-primary" value="Decrypt" onclick="DePlayfair(playfairtext, playfairkey, m11, m12, m13, m14, m15, m21, m22, m23, m24, m25, m31, m32, m33, m34, m35, m41, m42, m43, m44, m45, m51, m52, m53, m54, m55)"/>
                        <br><br><td rowspan="4" bgcolor="#FFCCCC" align="CENTER">
                            <input type="TEXT" name="m11" size="1"><input type="TEXT" name="m12" size="1"><input type="TEXT" name="m13" size="1"><input type="TEXT" name="m14" size="1"><input type="TEXT" name="m15" size="1"><br>
                            <input type="TEXT" name="m21" size="1"><input type="TEXT" name="m22" size="1"><input type="TEXT" name="m23" size="1"><input type="TEXT" name="m24" size="1"><input type="TEXT" name="m25" size="1"><br>
                            <input type="TEXT" name="m31" size="1"><input type="TEXT" name="m32" size="1"><input type="TEXT" name="m33" size="1"><input type="TEXT" name="m34" size="1"><input type="TEXT" name="m35" size="1"><br>
                            <input type="TEXT" name="m41" size="1"><input type="TEXT" name="m42" size="1"><input type="TEXT" name="m43" size="1"><input type="TEXT" name="m44" size="1"><input type="TEXT" name="m45" size="1"><br>
                            <input type="TEXT" name="m51" size="1"><input type="TEXT" name="m52" size="1"><input type="TEXT" name="m53" size="1"><input type="TEXT" name="m54" size="1"><input type="TEXT" name="m55" size="1"><br>
                        </td>
                    </form>
                </div>
                <div class="tab-pane fade" id="colpermutation">
                    <h2 class="funcTitle">Column Permutation</h2>
                    <form role="form">
                        <div class="form-group">
                            <label for="coltext" class="control-label">Text:</label>
                            <textarea class="form-control" id="coltext" cols="50" rows="10" style="width: 480px; height: 200px; margin: 0; resize: none;">Cryptography and Network Security Final Project</textarea>
                        </div>
                        <div class="form-group">
                            <label for="colkey" class="control-label">Key:</label>
                            <input class="form-control" type="text" id="colkey" value="abc" style="width:16em;"/>
                        </div>
                        <input type="button" class="btn btn-success" value="Encrypt" onclick="colEncrypt()"/>
                        <input type="button" class="btn btn-primary" value="Decrypt" onclick="colDecrypt()"/>
                    </form>
                </div>
                <div class="tab-pane fade" id="rc4">
                    <h2 class="funcTitle">RC4</h2>
                    <form role="form" action="#" method="get" onsubmit="return false">
                        <div class="form-group">
                            <label for="rc4text" class="control-label">Text:</label>
                            <textarea class="form-control" id="rc4text" cols="50" rows="10" style="width: 480px; height: 200px; margin: 0; resize: none;">Cryptography and Network Security Final Project</textarea>
                        </div>
                        <div class="form-group">
                            <label for="rc4key" class="control-label">Key:</label>
                            <input class="form-control" type="text" id="rc4key" value="abc" style="width:16em;"/>
                        </div>
                        <input type="button" class="btn btn-success" value="Encrypt" onclick="rc4Crypt(false)"/>
                        <input type="button" class="btn btn-primary" value="Decrypt" onclick="rc4Crypt(true)"/>
                    </form>
                </div>
                <div class="tab-pane fade" id="des">
                    <h2 class="funcTitle">DES</h2>
                    <form role="form" action="#" method="get" onsubmit="return false">
                        <div class="form-group">
                            <label for="DEStext" class="control-label">Text:</label>
                            <textarea class="form-control" id="DEStext" cols="50" rows="10" style="width: 480px; height: 200px; margin: 0; resize: none;"> Cryptography and Network Security Final Project </textarea>
                        </div>
                        <div class="form-group">
                            <label for="DESkey" class="control-label">Key:</label>
                            <input class="form-control" type="text" id="DESkey" value="abc" style="width:16em;"/>
                        </div>
                        <input type="button" class="btn btn-success" value="Encrypt" onclick="DESCrypt(false)"/>
                        <input type="button" class="btn btn-primary" value="Decrypt" onclick="DESCrypt(true)"/>
                    </form>
                </div>
                <div class="tab-pane fade" id="rsa">
                    <h2 class="funcTitle">RSA</h2>
                    <div>
                        <div class="btn-group">
                            <div class="btn btn-default">Key Size</div>
                            <div class="btn-group">
                                <button class="btn btn-default dropdown-toggle" id="key-size" type="button"
                                        data-value="1024" data-toggle="dropdown">1024 bit<span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="change-key-size" data-value="512" href="#">512 bit</a></li>
                                    <li><a class="change-key-size" data-value="1024" href="#">1024 bit</a></li>
                                    <li><a class="change-key-size" data-value="2048" href="#">2048 bit</a></li>
                                    <li><a class="change-key-size" data-value="4096" href="#">4096 bit</a></li>
                                </ul>
                            </div>
                            <button id="generate" class="btn btn-primary">Generate Key</button>
                        </div><br>
                        <span><i>
                            <small id="time-report"></small>
                        </i></span>
                        <label for="privkey">Private Key</label><br/>
                        <textarea class="form-control" id="privkey" rows="10"
                                  style="width: 480px; resize: none;"></textarea>
                        <label for="pubkey">Public Key</label><br/>
                        <textarea class="form-control" id="pubkey" rows="10" style="width: 480px; resize: none"
                                  readonly="readonly"></textarea>
                        <label for="input">Plain Text</label><br/>
                        <textarea class="form-control" id="input" name="input" rows="10"
                                  style="width: 480px; resize: none">Cryptography and Network Security Final Project</textarea>
                        <label for="crypted">Cipher Text</label><br/>
                        <textarea class="form-control" id="crypted" name="crypted" rows="10"
                                  style="width: 480px; resize: none"></textarea><br>
                        <button id="execute" class="btn btn-primary">Encrypt/Decrypt</button>
                        <script type="text/javascript">
                            $(function () {
                                //Change the key size value for new keys
                                $(".change-key-size").each(function (index, value) {
                                    var el = $(value);
                                    var keySize = el.attr('data-value');
                                    el.click(function (e) {
                                        var button = $('#key-size');
                                        button.attr('data-value', keySize);
                                        button.html(keySize + ' bit <span class="caret"></span>');
                                        e.preventDefault();
                                    });
                                });

                                // Execute when they click the button.
                                $('#execute').click(function () {

                                    // Create the encryption object.
                                    var crypt = new JSEncrypt();

                                    // Set the private.
                                    crypt.setPrivateKey($('#privkey').val());
                                    //return;
                                    // If no public key is set then set it here...
                                    var pubkey = $('#pubkey').val();
                                    if (!pubkey) {
                                        $('#pubkey').val(crypt.getPublicKey());
                                    }

                                    // Get the input and crypted values.
                                    var input = $('#input').val();
                                    var crypted = $('#crypted').val();

                                    // Alternate the values.
                                    if (input) {
                                        $('#crypted').val(crypt.encrypt(input));
                                        $('#input').val('');
                                    }
                                    else if (crypted) {
                                        var decrypted = crypt.decrypt(crypted);
                                        if (!decrypted)
                                            decrypted = 'This is a test!';
                                        $('#input').val(decrypted);
                                        $('#crypted').val('');
                                    }
                                });

                                var generateKeys = function () {
                                    var sKeySize = $('#key-size').attr('data-value');
                                    var keySize = parseInt(sKeySize);
                                    var crypt = new JSEncrypt({default_key_size: keySize});
                                    var async = $('#async-ck').is(':checked');
                                    var dt = new Date();
                                    var time = -(dt.getTime());
                                    if (async) {
                                        $('#time-report').text('.');
                                        var load = setInterval(function () {
                                            var text = $('#time-report').text();
                                            $('#time-report').text(text + '.');
                                        }, 500);
                                        crypt.getKey(function () {
                                            clearInterval(load);
                                            dt = new Date();
                                            time += (dt.getTime());
                                            $('#time-report').text('Calculation time ' + time + ' ms');
                                            $('#privkey').val(crypt.getPrivateKey());
                                            $('#pubkey').val(crypt.getPublicKey());
                                        });
                                        return;
                                    }
                                    crypt.getKey();
                                    dt = new Date();
                                    time += (dt.getTime());
                                    $('#time-report').text('Calculation time ' + time + ' ms');
                                    $('#privkey').val(crypt.getPrivateKey());
                                    $('#pubkey').val(crypt.getPublicKey());
                                };

                                // If they wish to generate new keys.
                                $('#generate').click(generateKeys);
                                generateKeys();
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="DH">
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <!-- multistep form -->
<form id="msform">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Image & Message</li>
		<li>Compression & Passowrd</li>
		<li>Output</li>
	</ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Select a Host Image from your PC</h2>
		<h3 class="fs-subtitle">STEP 1</h3>
        <div class="form-group">
            
             <p>Host Image:<input type="file" id="file" accept="image/*" onchange="previewFile1()"/>
            
           <img id="host" src="" height="200" alt="">
                 <br><br>
                 <br>
                 <br><br>
                 
                 
            </p>
            <p>
            <table style=" word-wrap: break-word; width: 65vw;">
            <tr>
                <td>Image To Hide:<input type="file" id="file1" onchange="previewFile()"/>
                </td><td>-------OR-------</td>
                <td rowspan="2">Text To Hide:<textarea id="msg" style="width:100%;height:300px;">This Awesome Message Will be Written into the Image!</textarea>
                </td>
            </tr>
            <tr><td><img id="hidden" src="" alt="Choose an image to hide and Preview here..."></td></tr>
                
                </table>
                 </p>
            
                   
            
            
                </div>
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Choose Compression Level & Password (if necessary)</h2>
		<h3 class="fs-subtitle">STEP 2</h3>
        <br>
        <br>
        <table width="100%">
            <tr>
                <td><div class="form-group">
                    <div>
                    <table>
                        <tr>
                            <td><input type="radio" name="mode" id="m0" value=0 checked="checked" />
                            </td>
                            <td><label for="m0">Level 0 - Best Secrecy, No Robustness to Compression</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="mode" id="m1" value=1 />
                            </td>
                            <td>
                                <label for="m1"> Level 1 - (Warning: This level has very low data capacity)</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="mode" id="m2" value=2 />
                            </td>
                            <td>
                                <label for="m2">Level 2</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="mode" id="m3" value=3 />
                            </td>
                            <td>
                                <label for="m3">Level 3</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="mode" id="m4" value=4 />
                            </td>
                            <td>
                                <label for="m4">Level 4</label>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input type="radio" name="mode" id="m5" value=5 />
                            </td>
                            <td>
                                <label for="m5">Level 5 - Best Robustness to Compression, Worst Secrecy</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">  <font style="color:red">If you're going to retrieve message, your level selected here must be the same level you use to generate the image!</font>
                            </td>
                        </tr>
                    </table>
  

</div>
                </div>
                </td>
                <td> <h4 style="color:Red">Optionally set/input a password for retrieving message</h4>
<p>Password: <input type="text" id="pass" value="" placeholder="No Password"/></p>
                </td>
            </tr>
            
                
                </table>
        <br>
        <br>
        <br>
        <br>
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Read from (or) write to Host Image</h2>
		<h3 class="fs-subtitle">STEP 3</h3>
		  <div class="form-group">
                  
<h4 style="color:red">RESULTS</h4>

<p>
<!--<textarea id="result" cols="50" rows="10" style="background-color: rgba(0,255,0,0.3); padding: 10px 10px 10px 10px; word-wrap: break-word;">Please finish step 1 & 2 and Click the button below. Your result will then show up here!</textarea>-->
<div id="result" style="background-color: rgba(0,255,0,0.3); padding: 10px 10px 10px 10px; word-wrap: break-word; max-width: 1350px;">Please finish step 1 & 2 and Click the button below. Your result will then show up here!</div>
<input type="button" id="toimage"  value="Click to convert to image" onclick="newAction()">  
              <img id="result1" src="" height="200" alt="Hidden Image Preview Here...">
</p>

<p>
<a href="javascript: writeIMG()" class="button" style="background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;"><span style="color:white">Write message into image</a>

OR
<a href="javascript: readIMG()" class="button" style="background-color: #f44336; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;"><span style="color:white">Read message from image</span></a>
<h3>
    </p>
    <p>
<img id="resultimg" style="display:none" src="" />

</p>
                </div>
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="button" name="start" class="start action-button" value="Start Again" />
	</fieldset>
</form>

<!-- jQuery -->
<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <form role="form">
                
                
              
            </form>
        </div>
       
    </div>



</div>
<script type="text/javascript" src="javascripts/jquery.min.js"></script> <!--jQuery is not required by the library. We use it in DEMO page-->
<!-- CryptoStego JS files.--> 
<script type="text/javascript" src="js/sha512.js"></script>
<script type="text/javascript" src="js/utf_8.js"></script>
<script type="text/javascript" src="js/crypto.js"></script>
<script type="text/javascript" src="js/readimg.js"></script>
<script type="text/javascript" src="js/setimg.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!-- above scripts equivalent to <script type="text/javascript" src="cryptostego.min.js"></script>-->
<script type="text/javascript">
function writeIMG(){
    $("#resultimg").hide();
    $("#resultimg").attr('src','');
    $("#result").html('Processing...');
    function writefunc(){
        var selectedVal = '';
        var selected = $("input[type='radio'][name='mode']:checked");
        if (selected.length > 0) {
            selectedVal = selected.val();
        }
        var t = writeMsgToCanvas('canvas',$("#msg").val(),$("#pass").val(),selectedVal);
        if(t!=null){ 
            var myCanvas = document.getElementById("canvas");  
            var image = myCanvas.toDataURL("image/png");    
            $("#resultimg").attr('src',image);
            $("#result").html('Success! Save the result image below and send it to others!');
            $("#resultimg").show();
        }
    }
    loadIMGtoCanvas('file','canvas',writefunc,500);
}
function readIMG(){
    $("#resultimg").hide();
    $("#result").html('Processing...');
    function readfunc(){
        var selectedVal = '';
        var selected = $("input[type='radio'][name='mode']:checked");
        if (selected.length > 0) {
            selectedVal = selected.val();
        }
        var t= readMsgFromCanvas('canvas',$("#pass").val(),selectedVal);
        if(t!=null){
            t=t.split('&').join('&amp;');
            t=t.split(' ').join('&nbsp;'); 
            t=t.split('<').join('&lt;');
            t=t.split('>').join('&gt;');
            t=t.replace(/(?:\r\n|\r|\n)/g, '<br />');
            $("#result").html(t);
        }else $("#result").html('ERROR REAVEALING MESSAGE!');
             
    }
    loadIMGtoCanvas('file','canvas',readfunc);
}
function previewFile() {
  var preview = document.getElementById("hidden");
  var file    = document.getElementById("file1").files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
    
    var encodedData = window.btoa(reader.result);
      document.getElementById("msg").value = encodedData;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}
    
    function previewFile1() {
  var preview = document.getElementById("host");
  var file    = document.getElementById("file").files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
    
    var encodedData = window.btoa(reader.result);
     
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}
    
function newAction() {
  var preview = document.getElementById("result1");
    var text = document.getElementById("result").innerHTML;
 var decodedData = window.atob(text);
    preview.src = decodedData;     
}
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});
    
    
 $(".start").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
     prev_fs = $(this).parent().prev();
	previous_fs = $(this).parent().prev().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	$("#progressbar li").eq($("fieldset").index(prev_fs)).removeClass("active");
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});   
    
    

$(".submit").click(function(){
	return false;
})


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
</script>
</body>
</html>
