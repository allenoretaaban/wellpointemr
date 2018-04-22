function getIndex(input)
{
    var index = -1, i = 0, found = false;
    while (i < input.form.length && index == -1)
        if (input.form[i] == input)index = i;
            else i++;
    return index;
}

function SendTab(objForm, strField, evtKeyPress)
{
    var aKey = evtKeyPress.keyCode ?
    evtKeyPress.keyCode :evtKeyPress.which ?
    evtKeyPress.which : evtKeyPress.charCode;
    if (aKey == 13)
    {
        objForm[(getIndex(objForm[strField])+1) % objForm.length].focus();
        return false;
    }
    return true;
}