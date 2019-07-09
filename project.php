<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>프로젝트</title>

    <link rel="stylesheet" href="./style/project.css">
    <link rel="stylesheet" href="./style/init.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="./script/library/dip.js"></script>
    <script src="./script/library/dip-component.js"></script>
    <script src="./script/library/dip-project.js"></script>
    <script src="./script/library/dip-hierarchy.js"></script>
    <script src="./script/library/dip-dips.js"></script>
    <script src="./script/member.js"></script>
  </head>

  <body>
    <?php
    session_start();
    include ("./db_connect.php");
    $connect = dbconn();
    $member = member();
    $dipconn = dipconn();

    $query = "SELECT * FROM DIP WHERE DipID = '$member[DipID]'";
    $result = mysqli_query($connect, $query);
    $ProjectIdArray[] = (int)$result['ProjectID'];
    $ProjectNameArray[] = $result['ProjectName'];

    $query2 = "SELECT * FROM PROJECT";
    $result2 = mysqli_query($connect, $query2);
    while($data2 = mysqli_fetch_array($result2)) {
      $AllProjectIdArray[] = (int)$data2['ProjectID'];
    }
    ?>

    <script>
      $(document).ready(function() {
        $(".ProjectCreate").click(function() {
          $(".CreateForm").slideToggle();
        });

        $(".openMask").click(function(e){
          e.preventDefault();
          wrapWindowByMask();
        });

        $(".window .close").click(function (e) {
          e.preventDefault();
          $("#mask, .modify").hide();
        });
        $("#mask").click(function () {
          $(this).hide();
          $(".modify").hide();
        });
      });

      function wrapWindowByMask(){
          var maskHeight = $(document).height();
          var maskWidth = $(window).width();

          $("#mask").css({"width":maskWidth,"height":maskHeight});
          $("#mask").fadeIn(0);
          $("#mask").fadeTo("slow",0.6);
          $(".modify").show();
      }

      var dip = new Dips();
      dip.setDipId(<?=$member['DipID']?>);
      var ProjectID = <?=json_encode($ProjectIdArray)?>;
      var ProjectName = <?=json_encode($ProjectNameArray)?>;
      var AllProjectId = <?=json_encode($AllProjectIdArray)?>;
      if(ProjectID == null) {
        ProjectID = new Array;
      } else {
        for(var i=0; i<ProjectID.length; i++){
          var project = new Dip();
          project.setProjectIndex(ProjectID[i]);
          project.setName(ProjectName[i]);
          dip.addDip(project);
        }
      }
      function CurProjectID() {
        if(ProjectID == null) {
          ProjectID = new Array;
        } else {
          for(var i=0; i<=ProjectID.length; i++){
            if (i == ProjectID.length) {
              return ProjectID[i-1];
            }
          }
        }
      }
      function CurAllProjectID() {
        if(AllProjectId == null) {
          AllProjectId = new Array;
          return 1;
        } else {
          for(var i=0; i<=AllProjectId.length; i++){
            if (i == AllProjectId.length) {
              return AllProjectId[i-1] + 1;
            }
          }
        }
      }

      function ObjectPost() {
        $.ajax({
              url: "projectCreate.php",
              type: "POST",
              data: {
                DipID : <?=$member['DipID']?>,
                ProjectID : CurAllProjectID(),
                ProjectName : $(".ProjectName").val()
               },
              success: function(data) {
                location.reload();
              },
              error:function(data){
              }
          });
          $(".CreateForm").slideUp();
      }

      function ProjectNameChange() {
        $.ajax({
              url: "projectNameChange.php",
              type: "POST",
              data: {
                ProjectIdInput : $(".ProjectIdInput").val(),
                ProjectNameInput : $(".ProjectNameInput").val()
               },
              success: function(data) {
                location.reload();
              },
              error:function(data){
              }
          });
      }
    </script>
    <!--logo-->
    <div class="logo">
      <a href="./index.php"><img class="logo_dip" src="./img/DIP_LOGO.png"></a>
    </div>
    <div class="nav_login">
      <?php if(!$member['MemberID']) {?>
        <div class="member"><a style="cursor:pointer;">로그인하세요</a></div>
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
            <div class="member"><a style="cursor:pointer;"><?php echo $member['MemberID']." (".$member['Name']."님)";?></a></div>
            <div class="member_bubble">
            <li class="member_sub"><a href="./logout.php">로그아웃</a></li>
            <li class="member_sub"><a href="./modify.php?no=<?=$member['DipID']?>&id=<?=$member['MemberID']?>">정보수정</a></li>
          </div>
            <?php }?>
    </div>

    <!--headContainer-->
    <div class="headContainer">
      <div class="headContainer_contents">
        <h2><?=$member['Name']?>님 안녕하세요.</h2>
        <h2>프로젝트를 생성해 볼까요?</h2>
      </div>
    </div>

    <!--mainContainer-->
    <div class="mainContainer">
      <button class="ProjectCreate" type="button" name="button">프로젝트 생성</button>
      <form class="CreateForm" hidden>
        <input type="text" class="ProjectName" name="ProjectName" value="">
        <button type="button" name="button" onclick="ObjectPost()">CREATE</button>
      </form>

      <div class="mainContainer_contents">
        <div class="table_layout">
          <?php
          $query = "SELECT * FROM DIP WHERE DipID = '$member[DipID]'";
          $result = mysqli_query($connect, $query);
          while($data = mysqli_fetch_array($result)) {
          ?>
            <table class="table_content" order="1">
                <tr class="table_attribute">
                  <td>프로젝트 이름</td>
                  <td>이름 수정</td>
                  <td>프로젝트 편집</td>
                  <td>파일 다운로드</td>
                </tr>
                <tr class="table_tr">
                  <td><script>document.write(dip.getProject(<?=$data['ProjectID']?>).getName())</script></td>
                  <td><button class="openMask" type="button" name="button">MODIFY</button></td>
                  <div id="mask"></div>
                      <div class="modify">
                        <form>
                          <input type="hidden" class="ProjectIdInput" name="ProjectIdInput" value="<?=$data['ProjectID']?>">
                          <input class="ProjectNameInput" name="ProjectNameInput" type="text" value="">
                          <button class="td_btn" type="button" name="button" onclick="ProjectNameChange()">MODIFY</button>
                        </form>
                      </div>
                  <td><button class="td_btn" type="button" name="button" onclick="location.href='./template.php?project=<?=$data['ProjectID']?>'">EDIT</button></td>
                  <td><button class="td_btn" type="button" name="button" onclick="<?fileDownload($data['ProjectID'])?>">DOWNLOAD</button></td>
                </tr>
            </table>
          <?php }?>
        </div>
      </div>
    </div>
    <?php
    function fileDownload($ProjectID) {
      $query = "SELECT * FROM TAB WHERE ProjectID = '$ProjectID'";
      $result = mysqli_query($connect, $query);
      $data = mysqli_fetch_array($result);
      $myfile = fopen("newHtml.html", "w");
      $html = $data['HTML'];
    }
    ?>
  </body>
</html>
