$(function showModalWindow() {
  // モーダルダイアログ側へ送るデータを準備
  var submit = document.getElementById("ModalContent").submit;
  // モーダルダイアログを開いて、結果のデータを受け取る
  var retString = showModalDialog("calender.general", SettingReservePart, "");
  // 受け取った結果を表示
  document.getElementById("ModalDialog").value = reserved;

});
