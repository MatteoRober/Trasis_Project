"use strict";
document.addEventListener('DOMContentLoaded', init);

function init() {

    console.log('DOM loaded and parsed');
    const link= document.querySelector('a#training');
    console.log(link);
    //link.addEventListener("click", function(){ alert("Hello World!"); });

    link.addEventListener("click", injectHtml);


}



function injectHtml() {
    //alert("Hello from inside injectHTML function");
    //console.log("at the start of the function");

    const $el = document.querySelector('.flex-trainingcards');

    console.log($el + " is the selected element");
    //Get the data from php

    //const data = getData(); //returns array of objects

    $el.innerHTML = "";

    const myArray = ["This is the first paragraph.", "This is the second paragraph.", "This is the third paragraph."];

    // Loop through the data and create html
    myArray.forEach(function(element) {
        $el.innerHTML += `
    <div class="trainingCard">
        <h2>Title: <?php echo $titleOfTraining?></h2>
        <p>Description: ${element}</p>
        <h3>Trainer: <?php echo $trainer?></h3>
        <p>Prerequisites: <?php echo $prerequisites?></p>
        <p>Duration: <?php echo $duration?> </p>
        <p>Accreditation: <?php echo $accreditation?> </p>
        <a href="#">Request training</a>
    </div>`;
    });

}

/*
function getData() {
    // Retrieve data from PHP

    //
}*/