import docReadyListener from './docReadyListener';
import BaseFunctionality from './baseFunctionality';
import AdminFunctionality from './adminFunctionality';


docReadyListener(function(){
  new BaseFunctionality();
  new AdminFunctionality();
});
