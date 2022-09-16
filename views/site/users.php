<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Felhasználók';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <button type="button" id="addUser" onclick='openModal()'>Felhasználó felvétele</button> <br>
    <div id="modal" style="display: none;">
<form action="/" method="post">
Teljes név: <input type="text" name="fullname"/>
Felhasználó név: <input type="text" name="username"/>
Jelszó: <input type="text" name="password"/>
Státusz: <input type="checkbox" name="is_use"/>
<button type="submit">Felhasználó mentése</button> <br>


</form>
    </div>
    <table>
        <thead>
            <tr>
                <td>Teljes név</td>
                <td>Felhasználó név</td>
                <td>Státusz</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allUsers as $user) : ?>
                <tr>
                    <td><?= $user->fullname ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $user->is_use ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    function openModal(){
        var modal = document.getElementById("modal");
        modal.style.display = "block";
    }

</script>