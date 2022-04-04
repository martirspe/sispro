<script>
function cal() {
  try {
    var a = parseInt(document.f.num1.value),
        b = parseInt(document.f.num2.value),
        c = parseInt(document.f.num3.value),
        d = parseInt(document.f.num4.value),
        e = parseInt(document.f.num5.value),
        f = parseInt(document.f.num6.value),
        g = parseInt(document.f.num7.value),
        h = parseInt(document.f.num8.value);
    document.f.sum.value = (a + b + c + d + e + f + g) * h;
  } catch (e) {
  }
}
</script>

<form name="f">
  <p>Número 1 + : <input type="number" name="num1" value="0" onchange="cal()" onkeyup="cal()" /></p>
  <p>Número 2 + : <input type="number" name="num2" value="0" onchange="cal()" onkeyup="cal()" /></p>
  <p>Número 3 + : <input type="number" name="num3" value="0" onchange="cal()" onkeyup="cal()" /></p>
  <p>Número 4 + : <input type="number" name="num4" value="0" onchange="cal()" onkeyup="cal()" /></p>
  <p>Número 5 + : <input type="number" name="num5" value="0" onchange="cal()" onkeyup="cal()" /></p>
  <p>Número 6 + : <input type="number" name="num6" value="0" onchange="cal()" onkeyup="cal()" /></p>
  <p>Número 7 + : <input type="number" name="num7" value="0" onchange="cal()" onkeyup="cal()" /></p>
  <p>Número 8 * : <input type="number" name="num8" value="0" onchange="cal()" onkeyup="cal()" /></p>
  <p>Suma: <input type="number" name="sum" value="0" readonly="readonly" /></p>
</form>