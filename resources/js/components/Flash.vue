<script>
export default {
    props:{
        content: String,
        type: {
            type: String,
            default: "notice"
        }
    },
    methods : {
        message: function(){
            return {
                content: this.content,
                type: this.type
            }
        },
        sendNotifier: function() {
            Bus.$emit('flash', this.message());
        }
    },
  mounted: function() {
    this.sendNotifier();
  },
  render: () => null,
}
</script>

