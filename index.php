<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Calculator</title>
  </head>
  <script>
    function setResult(val) {
      var result = document.getElementById("result").value;
      var lastValue = result.slice(-1);
      var islastValOpr = false;
      var isNewValOpr = false;
      switch (lastValue) {
        case "+":
        case "-":
        case "×":
        case "÷":
        case ".":
        case "":
          islastValOpr = true;
          break;
      }
    
      switch (val) {
        case "+":
        case "-":
        case "×":
        case "÷":
        case "":
        case ".":
          isNewValOpr = true;
          break;
      }
      if (islastValOpr && !isNewValOpr) {
        document.getElementById("result").value += val;
      } else if (!islastValOpr) {
        document.getElementById("result").value += val;
      }
    }
    function removeLastIndex() {
      var newVal = document.getElementById("result").value;
      newVal = newVal.substring(0, newVal.length - 1);
      document.getElementById("result").value = newVal;
    }
  </script>
  <?php
  if (isset($_REQUEST["submit"])) {
    if ($_POST["result"] != "") {
      $val = $_POST["result"];
      if (errHandel($val)) {
        $val = str_replace("×", "*", $val);
        $val = str_replace("÷", "/", $val);
        $holder = $_POST["result"];
        $holder .= "=";
        $result = eval("return ($val);");
      } else {
        $result = $_POST["result"];
      }
    }
  }
  if (isset($_REQUEST["clear"])) {
    $result = "";
    $holder = "";
  }
  function errHandel($argument)
  {
    if (is_numeric(substr($argument, -1)) && strlen($argument) != 1) {
      return true;
    }
  }
  ?>
  <body> 
    <form name="form" action="" method="post" class="calculator-body flex-column glass">
      <input type="text" name="holder " value="<?php if (isset($holder)) {
        echo $holder;
      } ?>" id="holder" maxlength="22" readonly/>
      <input type="text" name="result" value="<?php if (isset($result)) {
        echo $result;
      } ?>" id="result" maxlength="18" readonly/>

      <div class="grid-contaier flex-row">
        <div class="flex-column item1">
          <div class="flex-row">
            <input type="button" onclick="setResult(value)" value="7" />
            <input type="button" onclick="setResult(value)" value="8" />
            <input type="button" onclick="setResult(value)" value="9" />
            <input type="button" onclick="setResult(value)" value="÷" />
          </div>
          <div class="flex-row">
            <input type="button" onclick="setResult(value)" value="4" />
            <input type="button" onclick="setResult(value)" value="5" />
            <input type="button" onclick="setResult(value)" value="6" />
            <input type="button" onclick="setResult(value)" value="×" />
          </div>
          <div class="flex-row">
            <input type="button" onclick="setResult(value)" value="1" />
            <input type="button" onclick="setResult(value)" value="2" />
            <input type="button" onclick="setResult(value)" value="3" />
            <input type="button" onclick="setResult(value)" value="-" />
          </div>
          <div class="flex-row">
            <input type="button" onclick="setResult(value)" value="." />
            <input type="button" onclick="setResult(value)" value="0" />
            <input type="submit" name="clear" value="C" />
            <input type="button" onclick="setResult(value)" value="+" />
          </div>
        </div>
        <div class="flex-column item2">
          <input type="button" onClick="removeLastIndex()" name="back" value="←" id="back" style="height: 10vh"/>
          <input
            type="submit"
            name="submit"
            id="submit"
            value="="
            style="height: 30vh"
          />
        </div>
      </div>
      </form>
  </body>
</html>