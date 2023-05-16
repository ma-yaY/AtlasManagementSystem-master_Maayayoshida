$(function () {
  $('.danger-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    //変数定義
    var delete_part = $(this).attr('delete_part');
    var delete_date = $(this).val();

    //モーダルに送る記述
    $('.modal-inner-part #delete_part').val(delete_part);
    $('.modal-inner-part #delete_date').val(delete_date);

    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
