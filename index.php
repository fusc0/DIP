<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> :: DIP :: Design In Programming </title>

    <link rel="stylesheet" href="./style/init.css">
    <link rel="stylesheet" href="./style/font.css">
    <link rel="stylesheet" href="./style/index.css">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon">

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="./script/member.js"></script>
    <script>
    function fnMove(seq) {
      var offset = $("#div" + seq).offset();
      $('html, body').animate({scrollTop : offset.top - 70}, 350
      )
    }
    </script>

  </head>
  <body>
    <?php
    session_start();
    include ("./db_connect.php");
    $connect = dbconn();
    $member = member();
    ?>
    <div id="div1" class="window">
      <div class="upper_line"></div>
      <!-- fixed navigation -->
      <div class="nav">
        <!-- fixed logo -->
        <div class="nav_logo">
          <a href="./index.php"><img class="logo_dip" src="./img/DIP_LOGO_index.png"></a>
        </div>

        <!-- fixed Login button -->
        <div class="nav_login">
          <?php if(!$member['MemberID']) {?>
            <div class="member"><a style="cursor:pointer; color: #ff6600;">로그인하세요</a></div>
          <div class="member_bubble">
            <li class="member_sub"><a style="cursor:pointer;" id="login_toggle">로그인</a></li>
            <li>
              <div class="login" hidden>
                <form action="./login_post.php" name="login" method="post" id="form">
                  <input type="text" name="id" size="10" id="id" placeholder="아이디">
                  <input type="password" name="pw" size="10" id="pw" placeholder="비밀번호">
                  <input type="submit" value="로그인" id="login_btn" style="cursor:pointer;">
                </form>
              </div>
              <div id="message"></div>
            </li>
            <li class="member_sub"><a href="./register.php">회원가입</a></li>
          </div>
                <?php } else {?>
                <div class="member"><a style="cursor:pointer; color: #ff6600;"><?php echo $member['MemberID']." (".$member['Name']."님)";?></a></div>
                <div class="member_bubble">
                <li class="member_sub"><a href="./logout.php">로그아웃</a></li>
                <li class="member_sub"><a href="./modify.php?no=<?=$member['DipID']?>&id=<?=$member['MemberID']?>">정보수정</a></li>
              </div>
                <?php }?>
        </div>
      </div>

      <!-- container -->
      <div class="container">
        <!-- container_intro -->
        <div class="container_intro">

          <!--container_intro_introduce-->
          <div class="container_intro_introduce">
            <h1>Hello! We are DIP.</h1>
            <h3>당신만의 웹페이지를 만들어보세요!</h3>
          </div>

          <!-- container_intro_startNow_button -->
          <div class="container_intro_startNow_btn">
            <input type="button" onclick="location.href='./project.php'" name="start_now" value="Start Now">
          </div>
        </div>

        <!-- container_menu -->
        <div class="container_menu">
          <div class="container_menu_layout">
            <a href="#" onclick="fnMove('2')">
              <div class="container_menu_layout_element">
                About DIP
              </div>
            </a>
          </div>
          <div class="container_menu_layout">
            <a href="#" onclick="fnMove('3')">
              <div class="container_menu_layout_element">
                Show Case
              </div>
            </a>
          </div>
          <div class="container_menu_layout">
            <a href="#" onclick="fnMove('4')">
              <div class="container_menu_layout_element">
                Contact Us
              </div>
            </a>
          </div>
        </div>

        <!-- container_contents -->
        <div class="container_contents">
          <!-- ABOUT DIP -->
          <div id="div2" class="container_contents_aboutDIP">
            <div class="element_layout">
              <div class="aboutDIP_title_layout">
                  <div class="aboutDIP_title">
                    <h1>D&nbsp;&nbsp;&nbsp;I&nbsp;&nbsp;&nbsp;P</h1>
                    <h4>Design In Development</h4>
                  </div>
                </div>
              <div class="aboutDIP_body_layout">
                  <div class="aboutDIP_body">
                    <p>
                    DIP은 누구나 사용 할 수 있는 간편한 홈페이지 제작 방법을 제시합니다.
                    직접 코딩을 하지 못하는 사람도 누구나 자신만의 홈페이지를 제작을 할 수 있습니다.
                    창의성과 코딩의 한계를 뛰어넘어 자유롭게 자신의 생각을 표현하고 온라인 비즈니스를 운영하세요!
                    <br><br>
                    지금 당장 <b>시작</b>하세요!
                    <b>DIP</b>과 함께 라면 누구나 멋진 홈페이지를 제작 할 수 있습니다!
                    </p>
                  </div>
                </div>
            </div>
            <div class="aboutDIP_distinction_layout">
              <div class="distinction_element">
                <div class="element">
                  <img src="./img/person.png" alt="">
                  <p>혼자서도<br>만들 수 있습니다.</p>
                </div>
              </div>
              <div class="distinction_element">
                <div class="element">
                  <img src="./img/share.png" alt="">
                  <p>템플릿을<br>공유 할 수 있습니다.</p>
                </div>
              </div>
              <div class="distinction_element">
                <div class="element">
                  <img src="./img/document.png" alt="">
                  <p>HTML 문서로<br>만들어줍니다.</p>
                </div>
              </div>
              <div class="distinction_element">
                <div class="element">
                  <img src="./img/communication.png" alt="">
                  <p>디자이너와 개발자 사이의<br>의사소통을 쉽게 해줍니다.</p>
                </div>
              </div>
            </div>
          </div>

          <!-- SHOW CASE -->
          <div id="div3"class="container_contents_showCase">
            <div class="showCase_title_layout">
              <div class="showCase_title">
                <h1>Show Case</h1>
                <h4>DIP을 이용해 만든 다른 사용자들의 홈페이지를 구경해보세요.</h4>
              </div>
            </div>
            <div class="showCase_case_layout">

              <!-- case element -->
              <div class="case_element_layout">
                <div class="case_element">
                  <img src="./img/sample/exSite1.png" alt="">
                </div>
                <div class="case_element">
                  <img src="./img/sample/exSite2.png" alt="">
                </div>
                <div class="case_element">
                  <img src="./img/sample/exSite3.png" alt="">
                </div>
              </div>
              <div class="case_element_layout">
                <div class="case_element">
                  <img src="./img/sample/exSite4.png" alt="">
                </div>
                <div class="case_element">
                  <img src="./img/sample/exSite5.png" alt="">
                </div>
                <div class="case_element">
                  <img src="./img/sample/exSite6.png" alt="">
                </div>

              </div>

              <!-- View more Btton  -->
              <div class="showCase_ViewMore_btn">
                <input type="button" onclick="location.href='#.html'" name="view_more" value="Veiw More">
              </div>
            </div>
          </div>

          <!-- CONTACT US -->
          <div id="div4"class="container_contents_contactUs">
            <!-- contact us title -->
            <div class="contactUs_title_layout">
              <div class="contactUs_title">
                <h1>Contact Us</h1>
                <h4>문의사항은 연락주세요!</h4>
              </div>
            </div>
            <!--contact us body -->
            <div class="contactUs_body_layout">
              <div class="contactUs_body">
                <h3>Design In Programming</h3>
                <h3>063 - 680 - 7589    DIP</h3>
                <br>
                <br>
                <br>
                <h4>Designed by DIP</h4>
                <h4>Developed by DIP</h4>
              </div>
            </div>
          </div>
          <div class="page_bottom"></div>
        </div>
      </div>

      <!-- fixed_tailer -->
      <div class="fixed_tailer">
        <!-- tailer_TOP_button -->
        <div class="tailer_top_btn">
          <input type="button" onclick="fnMove('1')" name="top_button" value="TOP">
        </div>
      </div>

    </div>
  </body>
</html>
