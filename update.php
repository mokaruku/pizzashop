<?php
// DB接続
require './templates/db.php';
// エラーメッセージ
$errors = [
  'pizza' => '',
  'chef' => '',
];
// 入力値再反映用
$pizza = '';
$chef = '';
$topping = []; //追加
// チェックボックス用関数
function checkbox_value_exists($value)
{
  global $topping;
  // if (!array_key_exists('topping', $topping)) return; //削除
  if (in_array($value, $topping)) {
    echo 'checked';
  }
}
//送信チェック
if (isset($_POST['submit'])) {
  $check_keys = ['pizza', 'chef'];
  foreach ($check_keys as $key) {
    $_POST[$key] = trim(mb_convert_kana($_POST[$key], 's'));
  }
  $pizza = $_POST['pizza'];
  $chef = $_POST['chef'];
  // 検証(必須項目)
  if (empty($_POST['pizza'])) {
    // echo 'ピザの名前を入力してください。';
    $errors['pizza'] = 'ピザの名前を入力してください。';
  } elseif (!preg_match('/^([^\x01-\x7E]|[\da-zA-Z ])+$/', $_POST['pizza'])) {
    // echo '文字は正しく入力してください。';
    $errors['pizza'] = '文字は正しく入力してください。';
  }
  if (empty($_POST['chef'])) {
    // echo 'シェフの名前を入力してください。';
    $errors['chef'] = 'シェフの名前を入力してください。';
  } elseif (!preg_match('/^([^\x01-\x7E]|[\da-zA-Z ])+$/', $_POST['chef'])) {
    // echo '文字は正しく入力してください。';
    $errors['chef'] = '文字は正しく入力してください。';
  }
  // トッピングの存在チェック
  if (array_key_exists('topping', $_POST)) {
    $topping = $_POST['topping'];
  }
  // エラーチェック(エラーなければ)
  if (!array_filter($errors)) {
    // トッピングの存在チェック
    if (!empty($topping)) {
      $toppingStr = implode(',', $topping);
      $sql = '
        UPDATE pizzas
        SET pizza = ?, chef = ?, topping = ?
        WHERE id = ?
      ';
    } else {
      $sql = '
        UPDATE pizzas
        SET pizza = ?, chef = ?, topping = NULL
        WHERE id = ?
      ';
    }
    // DBへの登録
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $_POST['pizza']);
    $stmt->bindValue(2, $_POST['chef']);
    if (!empty($topping)) {
      $stmt->bindValue(3, $toppingStr);
      $stmt->bindValue(4, $_POST['id']);
    } else {
      $stmt->bindValue(3, $_POST['id']);
    }
    $result = $stmt->execute(); //true | false
    if ($result) {
      // リダイレクト
      header('Location:pizza.php');
      exit; // die;
    } else {
      echo 'DBへの登録に失敗しました。';
    }
  }
}
// 通常のページ表示
elseif (isset($_GET['id'])) {
  $stmt = $db->prepare('SELECT * FROM pizzas WHERE id = ?');
  $stmt->bindValue(1, $_GET['id']);
  $result = $stmt->execute();
  if ($result && $stmt->rowCount() === 1) {
    $pizzaData = $stmt->fetch();
    $pizza = $pizzaData['pizza'];
    $chef = $pizzaData['chef'];
    if (!is_null($pizzaData['topping'])) {
      $topping = explode(',', $pizzaData['topping']);
    }
  }
}
// idチェック(なかったらトップページへリダイレクト)
else {
  header('Location:pizza.php');
  exit;
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
            <?php
            $is_invalid = !empty($errors['pizza']) ? 'is-invalid' : '';
            ?>
            <input type="text" name="pizza" id="pizza" class="form-control <?= $is_invalid; ?>" value="<?= htmlspecialchars($pizza); ?>">
            <p class="invalid-feedback"><?= $errors['pizza']; ?></p>
          </div>
          <div class="mb-3">
            <label for="chef" class="form-label">シェフの名前</label>
            <?php
            $is_invalid = !empty($errors['chef']) ? 'is-invalid' : '';
            ?>
            <input type="text" name="chef" id="chef" class="form-control <?= $is_invalid; ?>" value="<?= htmlspecialchars($chef); ?>">
            <p class="invalid-feedback"><?= $errors['chef']; ?></p>
          </div>
          <div class="mb-3">
            <p>トッピング</p>
            <!-- tomato, cheese, basil, corn, mushroom -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="トマト" id="tomato" name="topping[]" <?php checkbox_value_exists("トマト") ?>>
              <label class="form-check-label" for="tomato">
                トマト
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="水牛モッツァレラチーズ" id="cheese" name="topping[]" <?php checkbox_value_exists("水牛モッツァレラチーズ") ?>>
              <label class="form-check-label" for="cheese">
                水牛モッツァレラチーズ
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="バジル" id="basil" name="topping[]" <?php checkbox_value_exists("バジル") ?>>
              <label class="form-check-label" for="basil">
                バジル
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="コーン" id="corn" name="topping[]" <?php checkbox_value_exists("コーン") ?>>
              <label class="form-check-label" for="corn">
                コーン
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="マッシュルーム" id="mushroom" name="topping[]" <?php checkbox_value_exists("マッシュルーム") ?>>
              <label class="form-check-label" for="mushroom">
                マッシュルーム
              </label>
            </div>
          </div>
          <div class="text-center">
            <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']); ?>">
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