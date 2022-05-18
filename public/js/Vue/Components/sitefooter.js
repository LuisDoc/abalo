/*
    Footer Komponente
*/
export default{
    $emit: ['contentSwitch'],
    methods:{
        handleSwitchToImpressum(){
            console.log("Handler called in Footer");
            this.$emit('contentSwitch','impressum');
        }
    },
    template: "#footer",
}