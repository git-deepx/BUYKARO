function change_css(_href) {
  if(_href == '../project/css/dark.css') {
    document.getElementById('css').href = '../project/css/light.css';
    
    return;
  }
  document.getElementById('css').href = '../project/css/dark.css';
}