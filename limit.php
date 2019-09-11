<div class="text-center" style="margin-top: 20px;" class="col-md-2">
    <form action="#" method="post">
        <select name="limit-records" id="limit-records">
            <option disabled="disabled" selected="selected">--Limit Rekord--</option>
                <?php foreach([5,10,20] as $limit): ?>
            <option <?php if(isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit) echo "selected" ?> value="<?= $limit; ?>">
                <?= $limit; ?></option>
                <?php endforeach; ?>
        </select>
    </form>
</div>