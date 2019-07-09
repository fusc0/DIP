$(document).ready(function() {
  $(".member").click(function() {
      if($(".member_bubble").is(":visible")) {
        $(".tail").slideUp("slow");
        setTimeout(function() {
          $(".member_bubble").slideUp();
          $("#message").slideUp();
          $(".member_bubble").animate({height: '100px'});
          $(".login").hide();
        }, 400);
      } else {
        $(".member_bubble").slideDown();
        setTimeout(function() {
          $(".tail").slideDown("slow");
        }, 200);
      }
  });
  $("#login_toggle").click(function() {
    if($(".login").is(":visible")){
      $(".login").hide(500);
      $(".member_bubble").animate({height: '100px'});
      $("#message").slideUp();
    } else {
      $(".login").show(500);
      $(".member_bubble").animate({height: '210px'});
    }
  });

  $("#login_btn").click(function() {
    var action = $("#form").attr('action');
    var form_data = {
      id: $("#id").val(),
      pw: $("#pw").val(),
      is_ajax: 1
    };
    $.ajax({
      type: "POST",
      url: action,
      data: form_data,
      success: function(response) {
        if(response == 'success') {
          $("#message").slideDown();
          $(".member_bubble").animate({height: '240px'});
          $("#message").html("<p style='color:blue'>로그인 성공!</p>");
          setTimeout(function() {
            $(".member_bubble").slideUp(1000, function() {
              location.reload();
              $("#message").slideUp(1000);
            });
          }, 600);

        }
        else if(response == 'fail_1') {
          $("#message").slideDown();
          $("#message").html("<p style='color:red'>아이디를 입력하세요.</p>");
          $(".member_bubble").animate({height: '240px'});
        } else if(response == 'fail_2') {
          $("#message").slideDown();
          $("#message").html("<p style='color:red'>존재하지 않는 <br>아이디입니다.</p>");
          $(".member_bubble").animate({height: '250px'});
        } else if(response == 'fail_3') {
          $("#message").slideDown();
          $("#message").html("<p style='color:red'>비밀번호를 입력하세요.</p>");
          $(".member_bubble").animate({height: '240px'});
        } else if(response == 'fail_4') {
          $("#message").slideDown();
          $("#message").html("<p style='color:red'>비밀번호를 확인하세요.</p>");
          $(".member_bubble").animate({height: '240px'});
        }

      }
    });
    return false;
  });
});
