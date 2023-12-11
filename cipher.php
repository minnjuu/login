<?php
function encrypt($password, $shift)
{
    $result = '';

    for ($i = 0; $i < strlen($password); $i++) {
        $char = $password[$i];

        if (ctype_alpha($char)) {
            $asciiOffset = ord(ctype_upper($char) ? 'A' : 'a');
            $result .= chr(($asciiOffset + ord($char) + $shift) % 26 + $asciiOffset);
        } else {
            $result .= $char;
        }
    }

    return $result;
}
 
// Driver Code
$text = "29A";
$s = 13;
echo "Text : " . $text;
echo "\nShift: " . $s;
echo "\nCipher: " . encrypt($text, $s);
 
?>