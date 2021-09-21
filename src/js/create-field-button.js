document.addEventListener('DOMContentLoaded', function (e) {
/* console.log('some test') */

function addNewField(elem) {

    const buttonIdStr = elem.id;
  
    const splitingArray = buttonIdStr.split("_");
  
    const filteredArray = splitingArray.filter(e => e !== "");
  
    const elemPrefix = filteredArray[0];
  
    const elemId = filteredArray[filteredArray.length-1];
  
    const elemPrefixSlicer = "_"+elemPrefix+"_";
  
    const elemIdSlicer = "_"+elemId;
  
    const parentIdStr = buttonIdStr.replace(elemPrefixSlicer, "").replace(elemIdSlicer, "");
  
    const parentElem = elem.closest("#"+parentIdStr);
  
    const parentNodes = parentElem.querySelectorAll('[id*='+parentIdStr+'');
  
    parentNodes.forEach(
    function(currentValue, currentIndex, listObj) {
  
      const node = parentNodes[currentIndex]
  
      if ( node.required && node.value === "" ) {
          elem.preventDefault();
      }
  
    },
    'myThisArg'
  );
  
      const arrayIds = parentIdStr.match(/\d+/g);
  
      const newIdLength = arrayIds ? arrayIds.length : null;
  
      const newId = arrayIds ? arrayIds[newIdLength] : null;
  
      const elementsParentIdStr = arrayIds ? parentIdStr.substring(0, parentIdStr.length - newIdLength) : parentIdStr
  
      const elements = document.querySelectorAll('div[id^='+elementsParentIdStr+'');
  
    let div = document.getElementById(parentIdStr),
      clone = div.cloneNode(true); // true means clone all childNodes and all event handlers
      id = elements.length;
      clone.id = elementsParentIdStr+""+id;
      elem.remove();
      document.body.appendChild(clone);
  
      const nodes = clone.querySelectorAll('[id*='+parentIdStr+'');
  
      nodes.forEach(
      function(currentValue, currentIndex, listObj) {
  
          nodes[currentIndex].id = nodes[currentIndex].id.replace(parentIdStr, clone.id);
  
          if ( nodes[currentIndex].id == clone.id+"_nonce_name") {
              nodes[currentIndex].value = nodes[currentIndex].value+""+id
          } else {
              nodes[currentIndex].value = "";
          }
    },
    'myThisArg'
  );
  
  }
});