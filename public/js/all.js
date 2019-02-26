function delSure() {
    var del = confirm('确定删除?')
    if (del){
        return true;
    }  else {
        return false;
    }
}