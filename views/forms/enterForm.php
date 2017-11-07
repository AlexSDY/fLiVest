<form>
    <div class="form-group">
      <input type="text" class="form-control" id="FIO"
      name="FIO" 
      placeholder="Имя"
      required />
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="phone"
      name="phone" 
      placeholder="8 (383)___-____"
      required />
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="date"
      name="date" 
      placeholder="Укажите дату"
      readonly 
      required />
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="time"
      name="order_time" 
      placeholder="Укажите время"
      required />
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="p_time"
      name="p_time" 
      placeholder="Удобное время для звонка">
    </div>
    <div class="form-group">
      <textarea class="form-control" id="extra" rows="4"
      name="extra"
        placeholder="Какие еще условия Вас интересуют"></textarea>
    </div>

  <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input" id="check152" checked="checked">
      <span>В соответствии Федеральным законом от 27.07.2006 №152-ФЗ "О персональных данных", даю свое добровольное согласие на обработку ПМЦ(ЗАО "МД ПРОЕКТ 2000")  моих персональных данных любым допускаемым законом способом. С Политикой в отношении обработки персональных данных ознакомлен.</span>
    </label>
    <div>
      <span class="right form_clear">Очистить</span>
    </div>
  </div>
  <input type="hidden" name="action" value="saveOrder" />

</form>