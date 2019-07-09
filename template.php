<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>
    <style media="screen">
      html, body { padding: 0; margin: 0; width: 100%; height: 100%; }
      .window { width: 100%; height: 100%; }
    </style>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="./style/drag.css">
    <link rel="stylesheet" href="./style/library/dip-component.css">
    <link rel="stylesheet" href="./style/library/dip.css">
    <link rel="stylesheet" href="./style/template.css">
    <link rel="stylesheet" href="./style/init.css">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="./script/library/dip.js"></script>
    <script src="./script/library/dip-component.js"></script>
    <script src="./script/library/dip-project.js"></script>
    <script src="./script/library/dip-layout.js"></script>
    <script src="./script/library/dip-hierarchy.js"></script>
    <script src="./script/key.js"></script>
    <script src="./script/resize.js"></script>
    <script src="./script/leftRightAnimation.js"></script>
    <script src="./script/attribute.js"></script>
    <script src="./script/directory.js"></script>
    <script src="./script/clickComponent.js"></script>
    <script src="./script/editableTitle.js"></script>
    <script src="./script/dragAndDropComponent.js"></script>
    <script src="./script/tab.js"></script>
    <script src="./script/accordion.js"></script>
    <script src="./script/submit.js"></script>
    <script src="./script/slider.js"></script>
    <script src="./script/paletteColor.js"></script>
    <script src="./script/fileUpload.js"></script>

    <?php
    session_start();
    include ("./db_connect.php");
    $connect = dbconn();
    $member = member();
    $dipconn = dipconn();

    $project = $_GET['project'];
    $query = "SELECT * FROM PROJECT WHERE ProjectID = '$project'";
    $data = mysqli_query($connect, $query);

    $query2 = "SELECT * FROM TAB";
    $result2 = mysqli_query($connect, $query2);
    while($data2 = mysqli_fetch_array($result2)) {
      $AllTabIdArray[] = (int)$data2['TabID'];
    }

    $query3 = "SELECT * FROM TAB WHERE ProjectID = '$project'";
    $result3 = mysqli_query($connect, $query3);
    while($data3 = mysqli_fetch_array($result3)) {
      $TabIdArray[] = (int)$data3['TabID'];
      $TabNameArray[] = $data3['TabName'];
      $HTMLArray[] = $data3['HTML'];
      $DevHTMLArray[] = $data3['DevHTML'];
    }
    ?>
    <script>
    var dip = new Dip();
    var tabIndex = <?=json_encode($TabIdArray)?>;
    var tabName = <?=json_encode($TabNameArray)?>;
    var Html = <?=json_encode($HTMLArray)?>;
    var DevHtml = <?=json_encode($DevHTMLArray)?>;
    var allTabId = <?=json_encode($AllTabIdArray)?>;
    dip.setProjectIndex(<?=$data['ProjectID']?>);
    dip.setName('<?=$data['ProjectName']?>');

    function CurTabID() {
          if(allTabId == null) {
            allTabId = new Array;
            return 1;
          } else {
            for(var i=0; i<=allTabId.length; i++){
              if (i == allTabId.length) {
                return allTabId[i-1] + 1;
              }
            }
          }
        }

    function saveHtmlFile() {

      if(dip.getProject().length == 0) {
        window.alert("제출하려면 최소 한개 이상의 탭이 있어야 합니다.");
      } else {
        for(var i=0; i<dip.getProject().length; i++) {
          dip.getProject()[i].saveHtml();
          dip.getProject()[i].setTabId(CurTabID() + i);
          $.ajax({
                url: "saveHtml.php",
                type: "POST",
                data: {
                  ProjectID : dip.getProjectIndex(),
                  TabID : dip.getProject()[i].getTabId(),
                  TabName : dip.getProject()[i].getName(),
                  DevHtml : dip.getProject()[i].getDevHtml(),
                  Html : dip.getProject()[i].getHtml()
                 },
                success: function(data) {

                },
                error:function(data){
                }
            });
        }
        window.alert("제출 완료!");
        location.href = './project.php';
      }
    }

    </script>
  </head>

  <body>
    <!-- window -->
    <div class="window">

      <!-- navigation -->
      <div class="nav">
        <!-- logo -->
        <div class="logo_layout">
          <a href="./index.html">
              <img class="logo" src="./img/DIP_LOGO_template.png" alt="">
          </a>
          <div class="logo_dip">Design In Programming</div>
        </div>

        <!-- <div class="search_layout">
            <input class="search" type="text" placeholder="  검색해보세요.">
        </div> -->
        <div class="tabs">
          <div class="tabAdd" onclick="addTab()">+</div>
        </div>

        <div class="saveBtn_layout">
        <!-- save file -->
          <div class="file">
            <button class="fileBtn" onclick="saveHtmlFile()">제출</button>
          </div>
        </div>
      </div>

      <!-- tool_fixed -->
      <div class="left" id="left">
      <div class="controller">

        <div class="tools_layout">
          <div class="tools">
              <button class="component">모양</button>
              <div class="panel">
                <div class="boxWrap" id="boxWrap">
                  <div class="draggable_tools" id="box">
                    <img src="./img/box.png"/>
                  </div>
                </div>

                <div class="circleWrap" id="circleWrap">
                  <div class="draggable_tools" id="circle">
                    <img  src="./img/circle.png"/>
                  </div>
                </div>
              </div>

              <button class="component">텍스트</button>
              <div class="panel">
                <div class="textNormalWrap" id="textNormalWrap">
                  <div class="draggable_tools" id="textNormal">
                    <img src="./img/text_normal.png"/>
                  </div>
                </div>

                <div class="textHeaderWrap" id="textHeaderWrap">
                  <div class="draggable_tools" id="textHeader">
                    <img src="./img/text_header.png">
                  </div>
                </div>
              </div>

              <button class="component">이미지</button>
              <div class="panel" id="imgPanel">
                <div class="imageList" id="imageList">
                  <div class="imageWrap" id="exSite2_imageWrap">
                    <div class="draggable_tools" id="exSite2_image">
                      <img src="./img/sample/exSite2.png" />
                    </div>
                  </div>
                </div>

                <div class="imageAdd">
                  <form action="" name="" id="imageForm">
                    <div class="imageFile_layout">
                      <div class="imgUpload_btn">
                        <label for="imgUpload">이미지 추가</label>
                         <input type="file" class="imgFile" id="imgUpload" name="image" accept=".jpg, .jpeg, .png" >
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <button class="component">테이블</button>
              <div class="panel">
                <div class="tableWrap" id="tableWrap">
                  <div class="draggable_tools" id="table">
                    <img src="./img/table.png"/>
                  </div>
                </div>
              </div>

              <button class="component">버튼</button>
              <div class="panel">
                <div class="buttonWrap" id="buttonWrap">
                  <div class="draggable_tools" id="button">
                    <p>버튼</p>
                  </div>
                </div>
              </div>

          </div>
         </div>

      </div>
      </div>

      <!-- attribute_fixed -->
      <div class="right" id="right">

      <!-- attribute controller -->
      <div class="attribute_controller">

        <div class="attribute_controller_layout">
          <!--attribute_controller-->
          <div class="attribute" id="attribute">
          </div>
          <!--directory-->
          <div class="directory" id="directory">
          </div>
          </div>
      </div>
      </div>

      <!-- center -->
      <div class="center">
        <div class="center_layout">


          <div class="contentAdd">
          </div>
        </div>

    </div>

    </div>
     <!-- window End -->
  </body>
</html>
<script>
if(tabIndex != null) {
  for(var i=0; i<tabIndex.length; i++) {
    loadTab(tabIndex[i], tabName[i], Html[i], DevHtml[i]);
  }
}
function loadTab(tabIndex, tabName, Html, DevHtml) {
  dip.getProject().push(new Project());

  dip.getProject()[i].setTabId(tabIndex);
  dip.getProject()[i].setName(tabName);
  dip.getProject()[i].setHtml(Html);
  dip.getProject()[i].setDevHtml(DevHtml);

  tabCount = dip.getProject().length - 1;
  var id = dip.getProject()[tabCount].getId();
  var tabName = dip.getProject()[tabCount].getName();


  var tabTemplate = "<div class='tabLink'  onclick='openTab(event, " + id + ")' id='" + "tab" + id + "' >" + tabName + " </div><div class='tabClose' onclick='closeTab(event, " + id + ")' id='" + "close" + id + "'>X</div>";
  var contentTemplate = "<div class='tabContent' id='" + "content" + id + "'>" + DevHtml + "</div>";

  $('.tabAdd').before(tabTemplate);
  $(".contentAdd").before(contentTemplate);

  STATUS = STATUS_ADD;
  var curTab = "tab" + (dip.getProjectId());
  document.getElementById(curTab).click();
}
</script>
