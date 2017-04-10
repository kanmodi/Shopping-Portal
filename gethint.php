<?php

$a[] = 'alienware';
$a[] = 'ball';
$a[] = 'balls';
$a[] = 'bat';
$a[] = 'bats';
$a[] = 'calvin';
$a[] = 'calvinklein';
$a[] = 'cap';
$a[] = 'casual';
$a[] = 'cleaner';
$a[] = 'cloth';
$a[] = 'clothes';
$a[] = 'clothing';
$a[] = 'computer';
$a[] = 'cosco';
$a[] = 'cricket';
$a[] = 'denim';
$a[] = 'drive';
$a[] = 'electronics';
$a[] = 'football';
$a[] = 'footwear';
$a[] = 'formal';
$a[] = 'gforce';
$a[] = 'grinder';
$a[] = 'inalsa';
$a[] = 'jack';
$a[] = 'jackandjone';
$a[] = 'jackandjones';
$a[] = 'jacket';
$a[] = 'jackets';
$a[] = 'jean';
$a[] = 'jeans';
$a[] = 'jones';
$a[] = 'keyboard';
$a[] = 'kingston';
$a[] = 'kitchen';
$a[] = 'klein';
$a[] = 'klien';
$a[] = 'lacoste';
$a[] = 'laptop';
$a[] = 'lawn';
$a[] = 'lawntennis';
$a[] = 'levis';
$a[] = 'lg';
$a[] = 'microsoft';
$a[] = 'microwave';
$a[] = 'mixer';
$a[] = 'mouse';
$a[] = 'mrf';
$a[] = 'nike';
$a[] = 'nivia';
$a[] = 'oven';
$a[] = 'pendrive';
$a[] = 'philips';
$a[] = 'phone';
$a[] = 'puma';
$a[] = 'racquet';
$a[] = 'samsung';
$a[] = 'sandal';
$a[] = 'sandals';
$a[] = 'shirt';
$a[] = 'shirts';
$a[] = 'shoe';
$a[] = 'shoes';
$a[] = 'short';
$a[] = 'shorts';
$a[] = 'sneakers';
$a[] = 'sport';
$a[] = 'sports';
$a[] = 'stud';
$a[] = 'studs';
$a[] = 'sweat';
$a[] = 'sweatshirt';
$a[] = 'tennis';
$a[] = 'timberland';
$a[] = 'titan';
$a[] = 'vacuum';
$a[] = 'vacuumcleaner';
$a[] = 'watch';
$a[] = 'watches';
$a[] = 'wearable';
$a[] = 'wearables';
$a[] = 'wilson';
$a[] = 'woodland';

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (strcmp($q, substr($name, 0, $len)) == 0) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
?>