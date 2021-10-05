<?php

$dataset1 = <<<DS1
NAME,LEG_LENGTH,DIET
Hadrosaurus,1.2,herbivore
Struthiomimus,0.92,omnivore
Velociraptor,1.0,carnivore
Euoplocephalus,1.6,herbivore
Stegosaurus,1.40,herbivore
Tyrannosaurus Rex,2.5,carnivore
DS1;

$dataset2 = <<<DS2
NAME,STRIDE_LENGTH,STANCE
Euoplocephalus,1.87,quadrupedal
Stegosaurus,1.90,quadrupedal
Tyrannosaurus Rex,5.76,bipedal
Hadrosaurus,1.4,bipedal
Struthiomimus,1.34,bipedal
Velociraptor,2.72,bipedal
DS2;

$DataSet1Arr = explode("\n", $dataset1);
$DataSet2Arr = explode("\n", $dataset2);
$DataSet = [];
$SortSet = [];

foreach ($DataSet1Arr as $index => $Data) {

    if ($index == 0) continue;

    $TData = explode(",", $Data);

    $DataSet[$TData[0]] = [
        'name' => $TData[0],
        'leg_length' => $TData[1],
        'diet' => $TData[2],
        'stride_length' => 0,
        'stance' => null,
        'speed' => 0,
    ];
}


foreach ($DataSet2Arr as $index => $Data) {

    if ($index == 0) continue;

    $TData = explode(",", $Data);

    $DataSet[$TData[0]]['stride_length'] = $TData[1];
    $DataSet[$TData[0]]['stance'] = $TData[2];
}


foreach ($DataSet as $index => $value) {
    $DataSet[$index]['speed'] = (($value['stride_length'] / $value['leg_length']) - 1) * sqrt($value['leg_length'] * 9.8);
}


foreach ($DataSet as $index => $value) {
    if (trim($DataSet[$index]['stance']) == "bipedal") 
    {
       $SortSet[$index] = $DataSet[$index]['speed'];
    }
}

$SortSet2 = [];

foreach ($SortSet as $index => $value)
    {
        $Max = $SortSet[$index];
        $SortSet2[] = $Max;
    }   

rsort($SortSet2);
//print_r($DataSet);

foreach ($SortSet2 as $index => $value)
    {   
        $Speed = $SortSet2[$index];
        foreach($DataSet as $index => $value)
        {
            if($Speed == $DataSet[$index]['speed'])
            echo ($DataSet[$index]['name']).PHP_EOL;
        }
    }





