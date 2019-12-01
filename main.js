let Peer = require('simple-peer')
let socket = io()
const video = document.querySelector('Video')
let client = {}

//get stream
navigator.mediaDevices.getUserMedia({video: true,audio: true})
.then(stream => {
  socket.emit('NewClient')
  video.srcObject = stream
  video.play()

//used to initialize a peer
  function InitPeer()
  {
    let peer = new peer({ initiator: (type == 'init') ? true : false, stream: stream, trickle: false
    peer.on('stream', function(stream){
      CreateVideo(stream)
    })
    peer.on('close',function(){
      document.getElementById("peerVideo").remove();
      peer.destroy()
    })
    return peer
   }
   //for peer of type init
   function MakePeer()
   {
     client.gotAnswer = false
     let peer = InitPeer('init')
     peer.on('signal',function(data){
       
     })
   }
 )
}
})
.catch(err => document.write(err))
