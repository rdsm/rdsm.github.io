// INITIALIZATION:

imagesDetails = new Array();
bouncingImages2 = new Object();

// CONFIGURATION:

imagesDetails[0] = new Object();
imagesDetails[0].width = 50;
imagesDetails[0].height = 50;
imagesDetails[0].src = './images/ghost.gif';

imagesDetails[1] = new Object();
imagesDetails[1].width = 40;
imagesDetails[1].height = 40;
imagesDetails[1].src = './images/ghost.gif';

imagesDetails[2] = new Object();
imagesDetails[2].width = 30;
imagesDetails[2].height = 30;
imagesDetails[2].src = './images/ghost.gif';

imagesDetails[3] = new Object();
imagesDetails[3].width = 30;
imagesDetails[3].height = 30;
imagesDetails[3].src = './images/ghost.gif';

imagesDetails[4] = new Object();
imagesDetails[4].width = 50;
imagesDetails[4].height = 50;
imagesDetails[4].src = './images/ghost.gif';

imagesDetails[5] = new Object();
imagesDetails[5].width = 40;
imagesDetails[5].height = 40;
imagesDetails[5].src = './images/ghost.gif';

imagesDetails[6] = new Object();
imagesDetails[6].width = 30;
imagesDetails[6].height = 30;
imagesDetails[6].src = './images/ghost.gif';

imagesDetails[7] = new Object();
imagesDetails[7].width = 30;
imagesDetails[7].height = 30;
imagesDetails[7].src = './images/ghost.gif';

// Template for further images:

   // imagesDetails[3] = new Object();
   // imagesDetails[3].width = ?;
   // imagesDetails[3].height = ?;
   // imagesDetails[3].src = '?';

bouncingImages2.frameRate = 30;
bouncingImages2.minRandomSpeed = 2;
bouncingImages2.maxRandomSpeed = 8;

// MAIN:

bouncingImages2.isLoaded = false;

var winWidth, winHeight;

if (dyn) {
   for (var imageLoop = 0; imageLoop < imagesDetails.length; imageLoop++) imagesDetails[imageLoop].imgObj = loadImg(imagesDetails[imageLoop].src); 
   }

function getWindowDimensions() {
   winWidth = getWinWidth();
   winHeight = getWinHeight();
   }

function loadBouncingImages2() {
   if (dyn && !bouncingImages2.isLoaded) {
      getWindowDimensions();
      for (var layerLoop = 0; layerLoop < imagesDetails.length; layerLoop++) {
         imagesDetails[layerLoop].dirX = (Math.round(Math.random()) == 0) ? 'left' : 'right';
         imagesDetails[layerLoop].dirY = (Math.round(Math.random()) == 0) ? 'up' : 'down';
         imagesDetails[layerLoop].posX = Math.floor(Math.random() * (winWidth - imagesDetails[layerLoop].width - 1)) + getDocScrollLeft();
         imagesDetails[layerLoop].posY = Math.floor(Math.random() * (winHeight - imagesDetails[layerLoop].height - 1)) + getDocScrollTop();
         imagesDetails[layerLoop].speedX = Math.round(Math.random() * (bouncingImages2.maxRandomSpeed - bouncingImages2.minRandomSpeed)) + bouncingImages2.minRandomSpeed;
         imagesDetails[layerLoop].speedY = Math.round(Math.random() * (bouncingImages2.maxRandomSpeed - bouncingImages2.minRandomSpeed)) + bouncingImages2.minRandomSpeed;
         imagesDetails[layerLoop].layerObj = addLayer('bouncingImagesLyr' + layerLoop);
         setLayerSize(imagesDetails[layerLoop].layerObj,imagesDetails[layerLoop].width,imagesDetails[layerLoop].height);
         setLayerClip(imagesDetails[layerLoop].layerObj,0,imagesDetails[layerLoop].width,imagesDetails[layerLoop].height,0);
         setLayerHTML(imagesDetails[layerLoop].layerObj,getImgTag('bouncingImagesImg' + layerLoop,imagesDetails[layerLoop].src,imagesDetails[layerLoop].width,imagesDetails[layerLoop].height,0));
         moveLayerTo(imagesDetails[layerLoop].layerObj,imagesDetails[layerLoop].posX,imagesDetails[layerLoop].posY);
         showLayer(imagesDetails[layerLoop].layerObj);
         }
      bouncingImages2.isLoaded = true;
      moveBouncingImages();
      }
   }

function moveBouncingImages() {
   for (var layerLoop = 0; layerLoop < imagesDetails.length; layerLoop++) {
      if (imagesDetails[layerLoop].dirX == 'left') {
         if (imagesDetails[layerLoop].posX > imagesDetails[layerLoop].speedX) imagesDetails[layerLoop].posX -= imagesDetails[layerLoop].speedX;
         else {
            imagesDetails[layerLoop].dirX = 'right';
            imagesDetails[layerLoop].posX = 0;
            }
         }
      else if (imagesDetails[layerLoop].dirX == 'right') {
         if (imagesDetails[layerLoop].posX + imagesDetails[layerLoop].width < winWidth - imagesDetails[layerLoop].speedX) imagesDetails[layerLoop].posX += imagesDetails[layerLoop].speedX;
         else {
            imagesDetails[layerLoop].dirX = 'left';
            imagesDetails[layerLoop].posX = winWidth - imagesDetails[layerLoop].width;
            }
         }
      if (imagesDetails[layerLoop].dirY == 'up') {
         if (imagesDetails[layerLoop].posY > imagesDetails[layerLoop].speedY) imagesDetails[layerLoop].posY -= imagesDetails[layerLoop].speedY;
         else {
            imagesDetails[layerLoop].dirY = 'down';
            imagesDetails[layerLoop].posY = 0;
            }
         }
      else if (imagesDetails[layerLoop].dirY == 'down') {
         if (imagesDetails[layerLoop].posY + imagesDetails[layerLoop].height < winHeight - imagesDetails[layerLoop].speedY) imagesDetails[layerLoop].posY += imagesDetails[layerLoop].speedY;
         else {
            imagesDetails[layerLoop].dirY = 'up';
            imagesDetails[layerLoop].posY = winHeight - imagesDetails[layerLoop].height;
            }
         }
      }
   for (var layerLoop = 0; layerLoop < imagesDetails.length; layerLoop++) moveLayerTo(imagesDetails[layerLoop].layerObj,imagesDetails[layerLoop].posX + getDocScrollLeft(),imagesDetails[layerLoop].posY + getDocScrollTop());
   window.setTimeout('moveBouncingImages()',bouncingImages2.frameRate);
   }

window.onresize = getWindowDimensions;
window.onload = loadBouncingImages2;