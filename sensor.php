<?php
    include("./session.php");
    include("./utils/check-login.php");
    include("./templates/header.php");
?>




<div class="container my-5">
    <div class="row">
        <div class="col-md-3">
            <div class="bg-white p-3 rounded">
                <?php include("./templates/logged_nav.php"); ?>
            </div>
        </div>

        <div class="col-md-9">
            <div class="bg-white p-3 rounded">
                <h1>Sensor Data</h1>
                <div id="sensorTable" style="max-width:100%; overflow: auto">
                </div>
            </div>
        </div>
    </div>
</div>




<script>
let options = {
  cache: "no-cache",
  credentials: "same-origin",
  headers: {
    "content-type": "application/json"
  },
  mode: "cors",
  redirect: "follow",
  referrer: "no-referrer"
};

let sensorTable = document.getElementById("sensorTable");

function buildUI(data) {
  let headers = Object.keys(data[0]);
  let th = headers.map(header => `<th>${header}</th>`);

  let tr = data.reduce((html, row) => {
    let td = [];
    Object.keys(row).forEach(col => {
      td.push(`<td>${row[col]}</td>`);
    });
    html.push(`<tr>${td.join("")}</tr>`);

    return html;
  }, []);

  let table = `
        <table class="table" >
            ${th.join("")}
            ${tr.join("")}
        </table>
        `;

  sensorTable.innerHTML = table;
  updateHighLow(data);
}

const getTemperatureSelector = ({ i }) =>
  `#sensorTable > table > tbody > tr:nth-child(${i + 2}) > td:nth-child(5)`;
const getHumiditySelector = ({ i }) =>
  `#sensorTable > table > tbody > tr:nth-child(${i + 2}) > td:nth-child(7)`;

function updateHighLow(data) {
  let [lowTemperature, , highTemperature] = data
    .map((row, i) => ({ temperature: row.temperature, i }))
    .slice()
    .sort((a, b) => a.temperature - b.temperature);
    
  let [lowHumidity, , highHumidity] = data
    .map((row, i) => ({ Humidity: row.humidity, i }))
    .slice()
    .sort((a, b) => a.humidity - b.humidity);

  document
    .querySelector(getTemperatureSelector(lowTemperature))
    .classList.add("bg-warning");
  document
    .querySelector(getTemperatureSelector(highTemperature))
    .classList.add("bg-danger");

  document
    .querySelector(getHumiditySelector(lowHumidity))
    .classList.add("bg-info");
  document
    .querySelector(getHumiditySelector(highHumidity))
    .classList.add("bg-primary");
}

function main() {
  let response = fetch(
    "http://www.deakin.edu.au/~asaravanan/project/json/sensor.json",
    options
  )
    .then(response => response.json())
    .then(({ sensorreadinglist }) => buildUI(sensorreadinglist));
}

main();

</script>
