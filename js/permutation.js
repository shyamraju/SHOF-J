function colEncrypt() {
    plaintext = document.getElementById("coltext").value.toUpperCase().replace(/[^A-Z]/g, "");
    if (plaintext.length < 1) {
        alert("Plaintext is empty");
        return;
    }
    var key = document.getElementById("colkey").value.toUpperCase().replace(/[^A-Z]/g, "");
    if (key.length <= 1) {
        alert("At least two key characters necessary");
        return;
    }
    var pc = "X";
    while (plaintext.length % key.length != 0) plaintext += pc.charAt(0);
    var colLength = plaintext.length / key.length;
    var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var ciphertext = "";
    k = 0;
    for (i = 0; i < key.length; i++) {
        while (k < 26) {
            t = key.indexOf(chars.charAt(k));
            arrkw = key.split("");
            arrkw[t] = "_";
            key = arrkw.join("");
            if (t >= 0) break;
            else k++;
        }
        for (var j = 0; j < colLength; j++) ciphertext += plaintext.charAt(j * key.length + t);
    }
    document.getElementById("coltext").value = ciphertext;
}

function colDecrypt() {
    ciphertext = document.getElementById("coltext").value.toUpperCase().replace(/[^A-Z]/g, "");
    if (ciphertext.length < 1) {
        alert("Ciphertext is empty");
        return;
    }
    var keyword = document.getElementById("colkey").value.toUpperCase().replace(/[^A-Z]/g, "");
    var klen = keyword.length;
    if (klen <= 1) {
        alert("At least two key characters");
        return;
    }
    var cols = new Array(klen);
    var colLength = ciphertext.length / klen;
    for (var i = 0; i < klen; i++) cols[i] = ciphertext.substr(i * colLength, colLength);
    var newcols = new Array(klen);
    var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    j = 0;
    i = 0;
    while (j < klen) {
        t = keyword.indexOf(chars.charAt(i));
        if (t >= 0) {
            newcols[t] = cols[j++];
            arrkw = keyword.split("");
            arrkw[t] = "_";
            keyword = arrkw.join("");
        } else i++;
    }
    var plaintext = "";
    for (var i = 0; i < colLength; i++) {
        for (var j = 0; j < klen; j++) plaintext += newcols[j].charAt(i);
    }
    document.getElementById("coltext").value = plaintext;
}
