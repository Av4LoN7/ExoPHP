<?php
// find median from data stream
$medianClass = new Median();

while (true) {
    $userNum = readline('Entrez un chiffre ou "n" pour terminer : ');
    if($userNum !== 'n' && is_numeric($userNum)) {
        $medianClass->addNum($userNum);
    } else {
        break;
    }
}

$resp = $medianClass->findMedian();
echo "median : " . $resp;

?>

<?php
class Median {
    private $storedValue = [];

    function addNum($num) {
        array_push($this->storedValue, $num);
    }

    function findMedian() {
        $count = count($this->storedValue);
        if($count % 2 === 1) {
            $medianIndex =  floor($count / 2);
            return $this->storedValue[$medianIndex];
        }
        return ( array_sum($this->storedValue) ) / $count;
    }
}
?>

