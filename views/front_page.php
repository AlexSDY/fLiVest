<!-- Button trigger modal -->
<button type="button" data-toggle="modal" data-target="#enterForm"></button>

<!-- Modal -->
<div class="modal fade" id="enterForm" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">ЗАЯВКА НА ЗАПИСЬ НА ПРИЕМ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include_once(PATH . '/views/forms/enterForm.php'); ?>
      </div>
      
        <button type="button" class="btn btn-success save_order">ОТПРАВИТЬ</button>

        <div id="info">
        </div>
    </div>
  </div>
</div>