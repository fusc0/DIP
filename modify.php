<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> :: DIP :: Design In Programming </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="./style/register.css">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon">
    <script>
    function cursorMove() {
      var len = document.member.tel_2.value.length;
      if(len == 4) {
        document.member.tel_3.focus();
      }
    }
    </script>
  </head>
  <body onload="init()">
    <div class="wrap">
      <div id="header">
        <h1>
          <a href="./index.php" class="header_logo"><img src="./img/DIP_LOGO.png" width="20%"></a>
        </h1>
      </div>
      <?php
      session_start();
      include ("./db_connect.php");
      $connect = dbconn();
      $member = member();

      $id = $_GET['id'];
      $no = $_GET['no'];
      ?>
      <!-- container -->
      <div id="container">
        <!-- content -->
        <div id="content">
          <div class="join_content">
            <div class="join_form">
              <fieldset class="join_form">
                <form action='./modify_post.php' name='modify' method='post' enctype="multipart/form-data">
                  <?php
                  $query = "SELECT * FROM MEMBER where DipID = '$no'";
                  mysqli_query($connect, "set names utf8");
                  $result = mysqli_query($connect, $query);
                  $data = mysqli_fetch_array($result);
                  ?>
                  <input type="hidden" name="no" value="<?=$member['DipID']?>">
                  <div class="row_group">
                    <input class="join_row" type='text' name='id' size='10' maxlength="20" placeholder="아이디" disabled value='<?=$member['MemberID']?>'>
                    <input class="join_row" type='password' name='pw_1' size='10' placeholder="비밀번호">
                    <input class="join_row" type='password' name='pw_2' size='10' placeholder="비밀번호 확인">
                  </div>
                  <div class="row_group">
                    <input class="join_row" type='text' name='name' size='5' placeholder="이름" disabled value='<?=$member['Name']?>'>
                    <div class="join_row join_sex">
                      <?php if($member['Sex'] == 'male') {?>
                      <span class="sex">
                        <span class="jender jender_line" id="man_checked">
                          <input type='radio' id="man" name='sex' value="male" disabled checked>
                          <label for="man" id="man_lb">남자</label>
                        </span>
                        <span class="jender" id="woman_checked">
                          <input type='radio' id="woman" name='sex' value="female" disabled>
                          <label for="woman" id="woman_lb">여자</label>
                        </span>
                      </span>
                      <?php }?>
                      <?php if($member['Sex'] == 'female') {?>
                      <span class="sex">
                        <span class="jender jender_line" id="man_checked">
                          <input type='radio' id="man" name='sex' value="male" disabled>
                          <label for="man" id="man_lb">남자</label>
                        </span>
                        <span class="jender" id="woman_checked">
                          <input type='radio' id="woman" name='sex' value="female" disabled checked>
                          <label for="woman" id="woman_lb">여자</label>
                        </span>
                      </span>
                      <?php }?>
                    </div>
                    <?php
                    $email = explode("@", $member['Email']);
                    $email_1 = $email[0];
                    $email_2 = $email[1];
                    $tel = explode("-", $member['Tel']);
                    $tel_1 = $tel[0];
                    $tel_2 = $tel[1];
                    $tel_3 = $tel[2];
                    $birth = explode("/", $member['Birth']);
                    $birth_1 = $birth[0];
                    $birth_2 = $birth[1];
                    $birth_3 = $birth[2];
                    ?>
                    <script>
                    function init() {
                        setEmail("<?=$email_2?>");
                        setBirth_1("<?=$birth_1?>");
                        setBirth_2("<?=$birth_2?>");
                        setBirth_3("<?=$birth_3?>");
                        setTel("<?=$tel_1?>")
                    }
                    function setEmail(val) {
                        var email_select = document.getElementById('email_select');
                        for (i=0, j=email_select.length; i<j; i++) {
                            if (email_select.options[i].value == val) {
                                email_select.options[i].selected = true;
                                break;
                            }
                        }
                    }
                    function setBirth_1(val) {
                        var birth_select_1 = document.getElementById('birth_select_1');
                        for (i=0, j=birth_select_1.length; i<j; i++) {
                            if (birth_select_1.options[i].value == val) {
                                birth_select_1.options[i].selected = true;
                                break;
                            }
                        }
                    }
                    function setBirth_2(val) {
                        var birth_select_2 = document.getElementById('birth_select_2');
                        for (i=0, j=birth_select_2.length; i<j; i++) {
                            if (birth_select_2.options[i].value == val) {
                                birth_select_2.options[i].selected = true;
                                break;
                            }
                        }
                    }
                    function setBirth_3(val) {
                        var birth_select_3 = document.getElementById('birth_select_3');
                        for (i=0, j=birth_select_3.length; i<j; i++) {
                            if (birth_select_3.options[i].value == val) {
                                birth_select_3.options[i].selected = true;
                                break;
                            }
                        }
                    }
                    function setTel(val) {
                        var tel_select = document.getElementById('tel_select');
                        for (i=0, j=tel_select.length; i<j; i++) {
                            if (tel_select.options[i].value == val) {
                                tel_select.options[i].selected = true;
                                break;
                            }
                        }
                    }
                    </script>
                    <div class="join_row join_birth">
                      <div class="join_birth">
                        <div class="birth_ymd">
                          <select name="birth_1" id="birth_select_1">
                                            <option value="2004">2004</option>
                                            <option value="2003">2003</option>
                                            <option value="2002">2002</option>
                                            <option value="2001">2001</option>
                                            <option value="2000">2000</option>
                                            <option value="1999">1999</option>
                                            <option value="1998" selected>1998</option>
                                            <option value="1997">1997</option>
                                            <option value="1996">1996</option>
                                            <option value="1995">1995</option>
                                            <option value="1994">1994</option>
                                            <option value="1993">1993</option>
                                            <option value="1992">1992</option>
                                            <option value="1991">1991</option>
                                            <option value="1990">1990</option>
                                          </select>
                                          <label for="birth_yyyy" class="birth_label">년</label>
                        </div>
                        <div class="birth_ymd">
                          <select name="birth_2" id="birth_select_2">
                              <option value="01">1</option>
                              <option value="02">2</option>
                              <option value="03">3</option>
                              <option value="04">4</option>
                              <option value="05">5</option>
                              <option value="06">6</option>
                              <option value="07">7</option>
                              <option value="08">8</option>
                              <option value="09">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                          </select>
                          <label for="birth_mm" class="birth_label">월</label>
                        </div>
                        <div class="birth_ymd">
                          <select name="birth_3" id="birth_select_3">
                              <option value="01">1</option>
                              <option value="02">2</option>
                              <option value="03">3</option>
                              <option value="04">4</option>
                              <option value="05">5</option>
                              <option value="06">6</option>
                              <option value="07">7</option>
                              <option value="08">8</option>
                              <option value="09">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                              <option value="16">16</option>
                              <option value="17">17</option>
                              <option value="18">18</option>
                              <option value="19">19</option>
                              <option value="20">20</option>
                              <option value="21">21</option>
                              <option value="22">22</option>
                              <option value="23">23</option>
                              <option value="24">24</option>
                              <option value="25">25</option>
                              <option value="26">26</option>
                              <option value="27">27</option>
                              <option value="28">28</option>
                              <option value="29">29</option>
                              <option value="30">30</option>
                              <option value="31">31</option>
                          </select>
                          <label for="birth_dd" class="birth_label">일</label>
                        </div>
                      </div>

                    </div>
                    <div class="join_row join_tel">
                      <div class="join_tel">
                        <div class="tel_number">
                          <select class="tel_box" name="tel_1" id="tel_select">
                            <option value="010">010</option>
                            <option value="010">011</option>
                            <option value="070">070</option>
                          </select>
                        </div>
                        <span class="tel_label">-</span>
                        <div class="tel_number">
                          <input class="tel_box" type='text' name='tel_2' size='1' maxlength="4" onkeyup="cursorMove()" value="<?=$tel_2?>">
                        </div>
                        <span class="tel_label">-</span>
                        <div class="tel_number">
                          <input class="tel_box" type='text' name='tel_3' size='1' maxlength="4" value="<?=$tel_3?>">
                        </div>
                      </div>
                    </div>
                    <div class="join_row join_email">
                      <div class="join_email">
                        <div class="email_box email_id">
                          <input type='text' name='email_1' size='10' value="<?=$email_1?>">
                        </div>
                        <label class="email_box_" for="">@</label>
                        <div class="email_box">
                          <input type="text" id="email_text" name="email_3" disabled value="<?=$email_2?>" size="10">
                        </div>
                        <div class="email_box">
                          <select id="email_select" name="email_2">
                            <option value="naver.com">naver.com</option>
                            <option value="daum.net">daum.net</option>
                            <option value="gmail.com">gmail.com</option>
                            <option value="nate.com">nate.com</option>
                            <option value="1">직접입력</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="register_btn">
                    <input type='submit' value='수정' style="cursor:pointer;">
                  </div>
                </form>
                  <button class="cancel_btn" onclick="history.back(-1)" style="cursor:pointer;">취소</button>
              </fieldset>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
    $('#email_select').change(function() {
      $("#email_select option:selected").each(function() {
      if($(this).val()== '1') {
      $("#email_text").val('');
      $("#email_text").attr("disabled", false);
    }
    else {
      $("#email_text").val($(this).text());
      $("#email_text").attr("disabled", true);
    }
    });
    });
    </script>
  </body>
</html>
