<?php
// エラーメッセージ
$errors = [
  'pizza' => '',
  'chef' => '',
];

//送信チェック
if (isset($_POST['submit'])) {

  var_dump($_POST);

  $check_keys = ['pizza', 'chef'];
  foreach ($check_keys as $key) {
    $_POST[$key] = trim(mb_convert_kana($_POST[$key], 's'));
  }
  //var_dump($_POST);
  // 検証(必須項目)
  if (empty($_POST['pizza'])) {
    // echo 'ピザの名前を入力してください。';
    $errors['pizza'] = 'ピザの名前を入力してください。';
  } elseif (!preg_match('/^([^\x01-\x7E]|[\da-zA-Z ])+$/', $_POST['pizza'])) {
    // echo '文字は正しく入力してください。';
    $errors['pizza'] = '文字は正しく入力してください。';
  }

  if (empty($_POST['chef'])) {
    echo 'シェフの名前を入力してください。';
    // echo 'シェフの名前を入力してください。';
    $errors['chef'] = 'シェフの名前を入力してください。';
  } elseif (!preg_match('/^([^\x01-\x7E]|[\da-zA-Z ])+$/', $_POST['chef'])) {
    echo '文字は正しく入力してください。';
    // echo '文字は正しく入力してください。';
    $errors['chef'] = '文字は正しく入力してください。';
  }
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
            <?php
            $is_invalid = !empty($errors['pizza']) ? 'is-invalid' : '';
            ?>
            <input type="text" name="pizza" id="pizza" class="form-control <?= $is_invalid; ?>">
            <p class="invalid-feedback"><?= $errors['pizza']; ?></p>
          </div>
          <div class="mb-3">
            <label for="chef" class="form-label">シェフの名前</label>
            <input type="text" name="chef" id="chef" class="form-control">
            <?php
            $is_invalid = !empty($errors['chef']) ? 'is-invalid' : '';
            ?>
            <input type="text" name="chef" id="chef" class="form-control <?= $is_invalid; ?>">
            <p class="invalid-feedback"><?= $errors['chef']; ?></p>
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