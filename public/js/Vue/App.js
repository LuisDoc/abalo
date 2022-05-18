import siteheader from "./Components/siteheader.js";
import sitefooter from "./Components/sitefooter.js";
import sitebody from "./Components/sitebody.js";

export default{
  data() {
    return{
      contentSwitch: "landingPage"
    }
  },
  methods:{
    changePage(content){
      this.contentSwitch = content;
      console.log("Current Content: ", this.contentSwitch);
      window.scroll(0,0);
    },
  },
  components:{
      siteheader,
      sitebody,
      sitefooter  
  },
  template: '<div><siteheader/><sitebody :contentSwitch="contentSwitch" @contentSwitch="changePage"/><sitefooter @contentSwitch="changePage"/></div>'
}
