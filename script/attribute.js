
function showAttrs(componentId) {
  attributeInnerHTML(componentId);
  if(Dip.RIGHT_STATE_FLAG == false) {
    openRight();
  }
  return componentId;
}

function attributeInnerHTML(componentId) {
  var componentAttrs = dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(componentId).getData().getAttrs();
  var attribute = document.getElementById("attribute");
  var innerhtml = "";

  for(var [key, value] of componentAttrs) {
    innerhtml += "<div class=\"attribute_div\">";
    innerhtml +=    "<span class=\"attribute_name\">" + key + "</span>";

    if(key == ("width")){
      innerhtml +=    "<div class=\"attribute_blank\"></div>"
      innerhtml +=    "<div id=\"slider_width\"></div>";
      innerhtml +=    "<input type=\"text\" id=\"amount_width\" marginLeft=\"20px\" readonly style=\"border:0; color:#f6931f; font-weight:bold;\" >";
      innerhtml +=    "<input class=\"input_area\" id=\"input" + key + "\" type=\"text\" value=\"" + value + "\">";
      innerhtml +=    "<input class=\"input_btn\" type=\"button\" value=\"설정\" onclick=\"clickFunc(" + componentId + ", '" + key + "', input" + key + ".value);\">";
    }
    else if(key == ("height")){
      innerhtml +=    "<div class=\"attribute_blank\"></div>"
      innerhtml +=    "<div id=\"slider_height\"></div>";
      innerhtml +=    "<input type=\"text\" id=\"amount_height\" marginLeft=\"20px\" readonly style=\"border:0; color:#f6931f; font-weight:bold;\" >";
      innerhtml +=    "<input class=\"input_area\" id=\"input" + key + "\" type=\"text\" value=\"" + value + "\">";
      innerhtml +=    "<input class=\"input_btn\" type=\"button\" value=\"설정\" onclick=\"clickFunc(" + componentId + ", '" + key + "', input" + key + ".value);\">";
    }
    else if(key == ("backgroundColor")){
      innerhtml +=    "<input class=\"jscolor\" id=\"input" + key + "\" value=\"" + value + "\">";
      innerhtml +=    "<input class=\"input_btn\" type=\"button\" value=\"설정\" onclick=\"clickFunc(" + componentId + ", '" + key + "', input" + key + ".value);\">";
    }

    else if(key ==("color")){
      innerhtml +=    "<input class=\"jscolor\" id=\"input" + key + "\" value=\"" + value + "\">";
      innerhtml +=    "<input class=\"input_btn\" type=\"button\" value=\"설정\" onclick=\"clickFunc(" + componentId + ", '" + key + "', input" + key + ".value);\">";
    }

    else{
      innerhtml +=  "<div class=\"input_wrap\">";
      innerhtml +=    "<input class=\"input_area\" id=\"input" + key + "\" type=\"text\" value=\"" + value + "\">";
      innerhtml +=    "<input class=\"input_btn\" type=\"button\" value=\"설정\" onclick=\"clickFunc(" + componentId + ", '" + key + "', input" + key + ".value);\">";
      innerhtml +=  "</div>";
  }

  innerhtml += "</div>";
}

  attribute.innerHTML = innerhtml;

  setWidthSlider(componentId);
  setHeightSlider(componentId);
  //setFontSize(componentId);


  jscolor.installByClassName('jscolor',componentId);


}

function clickFunc(id, key, value) {
  console.log(key + ", " + value);

  switch (key) {
    case "classify":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setClassify(value);
      break;
    case "width":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setWidth(value);
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setXYByPosition();
      $('#slider_width').slider('value', value);
      $('#amount_width').val(dip.parsePercentFromPixel(value, dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().getWidthMax()) + "%");
      break;
    case "height":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setHeight(value);
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setXYByPosition();
      $('#slider_height').slider('value', value);
      $('#amount_height').val(dip.parsePercentFromPixel(value, dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().getHeightMax()) + "%");
      break;
    case "backgroundColor":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setBackgroundColor("#" + value);
      break;
    case "float":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setFloat(value);
      break;
    case "marginLeft" :
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setMarginLeft(value);
      break;
    case "marginRight" :
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setMarginRight(value);
      break;
    case "marginTop":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setMarginTop(value);
      break;
    case "margminBottom" :
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setMarginBottom(value);
      break;
    case "paddingLeft":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setPaddingLeft(value);
      break;
    case "paddingRight":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setPaddingRight(value);
      break;
    case "paddingTop":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setPaddingTop(value);
      break;
    case "paddingBottom":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setPaddingBottom(value);
      break;
    case "borderLeft":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setBorderLeft(value);
      break;
    case "borderRight":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setBorderRight(value);
      break;
    case "borderTop":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setBorderTop(value);
      break;
    case "borderBottom":
    dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setBorderBottom(value);
      break;
    case "borderRadius":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setBorderRadius(value);
      break;
    case "borderTopLeftRadius":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setBorderTopLeftRadius(value);
      break;
    case "borderTopRightRadius":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setBorderTopRightRadius(value);
      break;
    case "borderBottomLeftRadius":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setBorderBottomLeftRadius(value);
      break;
    case "borderBottomRightRadius":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setBorderBottomRightRadius(value);
      break;
    case "text":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setText(value);
      break;
    case "fontStyle":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setFontStyle(value);
      break;
    case "fontSize":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setFontSize(value + "pt");
      break;
    case "color":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setColor("#" + value);
      break;
    case "fontWeight":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setFontWeight(value);
      break;
    case "fontFamily":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setFontFamily(value);
      break;
    case "textAlign":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setTextAlign(value);
      break;
    case "zIndex":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setZIndex(value);
      break;
    case "imageWidth":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setImageWidth(value);
      break;
    case "imageHeight":
      dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().setImageHeight(value);
      break;
  }

  dip.getProject()[dip.getIndexById(dip.getCurProjectId())].getHierarchy().getNode(id).getData().applyComponentAttrs();
  showDirectory();
}
