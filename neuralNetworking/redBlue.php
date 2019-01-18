<?php
require_once("../NeuralNetwork.php");
$n = new NeuralNetwork(4, 4, 1);  // the number of neurons in each layer of the network -- 4 input, 4 hidden and 1 output neurons
$n->setVerbose(false); // do not display error messages
//test data
// First array is input data, and the second is the expected output value (1 means blue and 0 means red)
$n->addTestData( array (0, 0, 255, 1), array (1));
$n->addTestData( array (0, 0, 192, 1), array (1));
$n->addTestData( array (208, 0, 49, 1), array (0));
$n->addTestData( array ( 228,  105, 116, 1), array (0));

$n->addTestData( array (128, 80, 255, 1), array (1));
$n->addTestData( array ( 248,  80, 68, 1), array (0));

$max = 3;
 // train the network in max 1000 epochs, with a max squared error of 0.01
 while (!($success=$n->train(1000, 0.01)) && $max-->0) {
// training failed -- re-initialize the network weights
     $n->initWeights();
 }

//training successful
if ($success) {
    $epochs = $n->getEpoch(); // get the number of epochs needed for training
}

$n->save('redBlue.ini');

?>