<?php

var_dump($_POST);
if (isset($_POST['submit'])) {
  var_dump($_POST);
}


require './templates/header.php';
// include './templates/header.php';
?>
<main>
  <div class="container">
    <h1 class="my-5 h2 text-center">ピザの登録</h1>
    <div class="row justify-content-center">
      <div class="col-md-8 bg-white p-4 rounded-4">
        <form action="" method="post">
          <div class="mb-3">
            <label for="pizza" class="form-label">ピザの名前</label>
            <input type="text" name="pizza" id="pizza" class="form-control">
          </div>
          <div class="mb-3">
            <label for="chef" class="form-label">シェフの名前</label>
            <input type="text" name="chef" id="chef" class="form-control">
          </div>
          <div class="mb-3">
            <p>トッピング</p>
            <!-- tomato, cheese, basil, corn, mushroom -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="トマト" id="tomato" name="topping[]">
              <label class="form-check-label" for="tomato">
                トマト
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="水牛モッツァレラチーズ" id="cheese" name="topping[]">
              <label class="form-check-label" for="cheese">
                水牛モッツァレラチーズ
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="バジル" id="basil" name="topping[]">
              <label class="form-check-label" for="basil">
                バジル
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="コーン" id="corn" name="topping[]">
              <label class="form-check-label" for="corn">
                コーン
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="マッシュルーム" id="mushroom" name="topping[]">
              <label class="form-check-label" for="mushroom">
                マッシュルーム
              </label>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">送信する</button>
            <button type="submit" class="btn btn-primary" name="submit">送信する</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
<?php
require './templates/footer.php';
?>