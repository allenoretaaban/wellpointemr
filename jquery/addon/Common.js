// JScript File

// http://www.faqts.com/knowledge_base/view.phtml/aid/13562

function setSelectionRange(input, selectionStart, selectionEnd) {
  if (input.setSelectionRange) {
    input.focus();
    input.setSelectionRange(selectionStart, selectionEnd);
  } else if (input.createTextRange) {
    input.focus();
    var range = input.createTextRange();
    range.collapse(true);
    range.moveEnd('character', selectionEnd);
    range.moveStart('character', selectionStart);
    range.select();
  }
}

function setCaretToEnd(input) 
{
  setSelectionRange(input, input.value.length, input.value.length);
}

// http://www.porjes.com/idocs/forms/index_famsupp_162.html

var downStrokeField;

function autojump(formName, fieldName, nextFieldName, min, max, msg)
{
  var myField = formName.elements[fieldName];

  myField.nextField = formName.elements[nextFieldName];
  
  myField.min = min;
  myField.max = max;
  myField.msg = msg;
  
  myField.onkeydown = autojump_keyDown;
  myField.onkeyup = autojump_keyUp;
}

function autojump_keyDown()
{
  this.beforeLength=this.value.length;
  downStrokeField=this;
}

function autojump_keyUp()
{
  if ((this == downStrokeField) && 
      (this.value.length > this.beforeLength) && 
      (this.value.length >= this.maxLength))
  {
  
    if (changeRange(this.value, this.min, this.max))
    {
      this.nextField.focus();
    }
    else
    {
      alert(this.msg);
      this.focus();
      return;
    }
    
    try
    {
      this.nextField.select();
    } catch (ex) {}
  }
   
  downStrokeField=null;
}

////////////////////////////////////////////////////////////////

function changeRange(val, min, max)
{
  if ((val >= min) && (val <= max))
    return true;
  else
    return false;  
}