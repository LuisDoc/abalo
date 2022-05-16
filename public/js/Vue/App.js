import siteheader from "./Components/siteheader.js";
import sitefooter from "./Components/sitefooter.js";
import sitebody from "./Components/sitebody.js";

export default{
  components:{
      siteheader,
      sitebody,
      sitefooter  
  },
  template: "<div><siteheader/><sitebody/><sitefooter/></div>"
}
