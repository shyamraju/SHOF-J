alphabet = 'ABCDEFGHIJKLMNOPQRSTUVXYZ';

function standard(entry)
{
    entry.value = entry.value.toUpperCase();
    var enLength = entry.value.length;
    var entry_standard = '';
    for (var i = 0; i < enLength; i++)
    {
        if (alphabet.indexOf(entry.value.charAt(i))!=-1)
        {
            entry_standard += entry.value.charAt(i)
        }
    }
    entry.value = entry_standard;
}

function Shyamplayfair(key)
{
    standard(key);
    var grille = '';
    for (var i = 0; i < key.value.length; i++) {
        ch = key.value.charAt(i);
        if (grille.indexOf (ch) < 0) {
            grille += ch
        }
    }
    for (var i = 0; i < alphabet.length; i++) {
        ch = alphabet.charAt(i);
        if (grille.indexOf (ch) < 0) {
            grille += ch
        }
    }
    return grille
}

function Playfair(text, key, m11, m12, m13, m14, m15, m21, m22, m23, m24, m25, m31, m32, m33, m34, m35, m41, m42, m43, m44, m45, m51, m52, m53, m54, m55)
{
    var matrix = Shyamplayfair(key);
    n = 0;
    standard(text);
    var output = "";
    for (var i = 0; i < text.value.length; i = i + 2) {
        ch1 = text.value.charAt(i);
        ch2 = text.value.charAt(i + 1);
        if (ch1 == ch2) {
            ch2 = "X";
            i = i-1
        }
        ord1 = matrix.indexOf(ch1);
        ligne1 = Math.floor(ord1 / 5);
        col1 = ord1 % 5;
        ord2 = matrix.indexOf(ch2);
        ligne2 = Math.floor(ord2 / 5);
        col2 = ord2 % 5;
        if (ligne1 == ligne2) {
            if ((n%5 == 0) && (n > 0)) {
                output += ""
            }
            n++;
            output += matrix.charAt(5 * ligne1 + (col1 + 1)%5);
            if ((n%5 == 0) && (n > 0)) {
                output += ""
            }
            n++;
            output += matrix.charAt(5 * ligne2 + (col2 + 1)%5);
        } else if (col1 == col2) {
            if ((n%5 == 0) && (n > 0)) {
                output += ""
            }
            n++;
            output += matrix.charAt(col1 + 5 * ((ligne1 + 1)%5));
            if ((n%5 == 0) && (n > 0)) {
                output += ""
            }
            n++;
            output += matrix.charAt(col2 + 5 * ((ligne2 + 1)%5));
        } else {
            if ((n%5 == 0) && (n > 0)) {
                output += ""
            }
            n++;
            output += matrix.charAt(5 * ligne1 + col2);
            if ((n%5 == 0) && (n > 0)) {
                output += ""
            }
            n++;
            output += matrix.charAt(5 * ligne2 + col1);
        }
    }
    m11.value = matrix.charAt(0);
    m12.value = matrix.charAt(1);
    m13.value = matrix.charAt(2);
    m14.value = matrix.charAt(3);
    m15.value = matrix.charAt(4);
    m21.value = matrix.charAt(5);
    m22.value = matrix.charAt(6);
    m23.value = matrix.charAt(7);
    m24.value = matrix.charAt(8);
    m25.value = matrix.charAt(9);
    m31.value = matrix.charAt(10);
    m32.value = matrix.charAt(11);
    m33.value = matrix.charAt(12);
    m34.value = matrix.charAt(13);
    m35.value = matrix.charAt(14);
    m41.value = matrix.charAt(15);
    m42.value = matrix.charAt(16);
    m43.value = matrix.charAt(17);
    m44.value = matrix.charAt(18);
    m45.value = matrix.charAt(19);
    m51.value = matrix.charAt(20);
    m52.value = matrix.charAt(21);
    m53.value = matrix.charAt(22);
    m54.value = matrix.charAt(23);
    m55.value = matrix.charAt(24);
    text.value = output;
}

function DePlayfair(text, key, m11, m12, m13, m14, m15, m21, m22, m23, m24, m25, m31, m32, m33, m34, m35, m41, m42, m43, m44, m45, m51, m52, m53, m54, m55)
{
    var matrix = Shyamplayfair(key);
    standard(text);
    var output = "";
    for (var i = 0; i < text.value.length; i = i + 2) {
        ch1 = text.value.charAt(i);
        ch2 = text.value.charAt(i + 1);
        ord1 = matrix.indexOf(ch1);
        ligne1 = Math.floor(ord1 / 5);
        col1 = ord1 % 5;
        ord2 = matrix.indexOf(ch2);
        ligne2 = Math.floor(ord2 / 5);
        col2 = ord2 % 5;
        if (ligne1 == ligne2) {
            output += matrix.charAt(5 * ligne1 + (col1 + 4)%5);
            output += matrix.charAt(5 * ligne2 + (col2 + 4)%5);
        } else if (col1 == col2) {
            output += matrix.charAt(col1 + 5 * ((ligne1 + 4)%5));
            output += matrix.charAt(col2 + 5 * ((ligne2 + 4)%5));
        } else {
            output += matrix.charAt(5 * ligne1 + col2);
            output += matrix.charAt(5 * ligne2 + col1);
        }
    }
    m11.value = matrix.charAt(0);
    m12.value = matrix.charAt(1);
    m13.value = matrix.charAt(2);
    m14.value = matrix.charAt(3);
    m15.value = matrix.charAt(4);
    m21.value = matrix.charAt(5);
    m22.value = matrix.charAt(6);
    m23.value = matrix.charAt(7);
    m24.value = matrix.charAt(8);
    m25.value = matrix.charAt(9);
    m31.value = matrix.charAt(10);
    m32.value = matrix.charAt(11);
    m33.value = matrix.charAt(12);
    m34.value = matrix.charAt(13);
    m35.value = matrix.charAt(14);
    m41.value = matrix.charAt(15);
    m42.value = matrix.charAt(16);
    m43.value = matrix.charAt(17);
    m44.value = matrix.charAt(18);
    m45.value = matrix.charAt(19);
    m51.value = matrix.charAt(20);
    m52.value = matrix.charAt(21);
    m53.value = matrix.charAt(22);
    m54.value = matrix.charAt(23);
    m55.value = matrix.charAt(24);
    text.value = output;
}
