$().ready(function() {
  function randomColor() {
    var r = Math.floor(Math.random() * 10) + 1;
    if (r <= 6)
      return "#337ab7";
    if (r > 6 && r <= 8)
      return "#daa520";
    return "#000000"
  }
  Snake = function() {
    this.setCanvas(canvas);

    this.x = this.canvasWidth/2;
    this.y = this.canvasHeight;
    this.radius = 10;
    this.speed = this.canvasWidth/500;
    this.angle = Math.PI/2;
    this.angleDiversion = 
    this.fillStyle = '#337ab7';
    this.shadowColor = '#A9A9A9';

    this.shadowBlur = 2;
    this.generation = 0;
    this.lifespan = 0;
    this.totalDistance = 0;
    this.distance = 0;
  };
  Snake.prototype = {
      setShadow: function(color) {
          this.shadowColor = color;
      },
      setColor: function(color) {
          this.fillStyle = color;
      },
    setCanvas: function(canvas) {
      this.canvas = canvas;
      this.context = canvas.getContext("2d");
      this.$canvas = jQuery(canvas);
      this.canvasWidth = $canvas.width();
      this.canvasHeight = $canvas.height();
    },

    next: function() {
      this.draw();
      this.iterate();
      this.randomize();
  // 		this.limitSpeed();
  // 		this.reset(context);
      this.split();
      this.lifespan++;
      this.die();
    },
    rotateColor: function() {
      this.shadowColor =   '#' + Math.floor(Math.random()*16777215).toString(16);
      this.shadowBlur = '#' + Math.floor(Math.random()*16777215).toString(16);
    },
    draw: function() {
      var context = this.context;
      context.save();
      context.fillStyle = this.fillStyle;
      context.shadowColor = this.shadowColor;
      context.shadowBlur = this.shadowBlur;
      context.beginPath();
      context.moveTo(this.x, this.y);
      context.arc(this.x, this.y, this.radius, 0, 2*Math.PI, true);
      context.closePath();
      context.fill();
      context.restore();
    },

    iterate: function() {
      var lastX = this.x;
      var lastY = this.y;
      this.x += this.speed * Math.cos(this.angle);
      this.y += this.speed * -Math.sin(this.angle);
      this.radius *= (0.99 - this.generation/200); // minus 0.004 per generation
      var deltaDistance = Math.sqrt(Math.abs(lastX-this.x) + Math.abs(lastY-this.y));
      this.distance += deltaDistance;
      this.totalDistance += deltaDistance;
      if (this.speed > this.radius*2)
        this.speed = this.radius*2;
    },

    randomize: function() {
      this.angle += Math.random()/5 - 1/5/2;
    },

    reset: function(context) {
      var $canvas = jQuery(context.canvas);
      var margin = 30+this.radius;
      var width = $canvas.width();
      var height = $canvas.height();

      if (this.x < -margin || this.x > width+margin || this.y < -margin || this.y > height+margin) {
  // 			this.x = width/2;
        this.y = height;
        // New color
        var grey = Math.floor(Math.random()*255).toString(16);
        this.fillStyle = "#" + grey + grey + grey;
        this.shadowColor = this.fillStyle;
      }
    },

    split: function() {
      // Calculate split chance
      var splitChance = 0;
      // Trunk
      if (this.generation == 0)
        splitChance = (this.distance-this.canvasHeight/5)/100;
      // Branch
      else if (this.generation < 3)
        splitChance = (this.distance-this.canvasHeight/10)/100;

      // Split if we are allowed
      if (Math.random() < splitChance) {
        var n = 2+Math.round(Math.random()*2);
        for (var i=0 ; i<n ; i++) {
          var snake = new Snake(this.canvas);
          snake.x = this.x;
          snake.y = this.y;
          snake.angle = this.angle;
          snake.speed = this.speed;
          snake.radius = this.radius * 0.9;
          snake.generation = this.generation + 1;
          snake.fillStyle = this.fillStyle;
          snake.shadowColor = this.shadowColor;
          snake.shadowBlur = this.shadowBlur;
          snake.totalDistance = this.totalDistance;
          this.collection.add(snake);
        }
        this.collection.remove(this);
      }
    },

    die: function() {
      if (this.radius < 0.02) {
        this.collection.remove(this);
        var item = $("");
        item.css({position: "fixed", left: this.x, top: this.y, width: "1em", height: "1em"});
        $("body").append(item);
        item.draggable();

        $('body').droppable({
          drop: function(event, ui){
            handlePokeDrop(ui.draggable);
          }
        });

      } else if( this.radius > 15 && this.radius < 16){
            this.fillStyle = randomColor();
      }
    }
  }
  SnakeCollection = function() {
    this.canvas = canvas;

    this.snakes = [];
  }
  SnakeCollection.prototype = {
    next: function() {
      n = this.snakes.length;
      for (var s in this.snakes) {
        var snake = this.snakes[s];
        if (this.snakes[s])
          this.snakes[s].next();
      }
    },

    add: function(snake) {
      this.snakes.push(snake);
      snake.rotateColor();
      snake.collection = this;
    },

    remove: function(snake) {
      for (var s in this.snakes)
        if (this.snakes[s] === snake)
          this.snakes.splice(s, 1);
    },
    reset: function() {
      n = this.snakes.length;
      for (var s in this.snakes) {
        var snake = this.snakes[s];
        this.remove(snake);
      }	    
    }
  }
  function randHex() {
    var num = Math.round(Math.random() * 255).toString(16);
    if (num.length == 1)
      num = "0"+num;
    return num;
  }
  function init() {
    // Dimensions
    var width = $canvas.width();
    var height = $canvas.height();

    // Set actual canvas size to match css
    $canvas.attr("width", width);
    $canvas.attr("height", height);

    // Frame rate
    var frame = 0;

    // Snakes
    var n = 22;
    var initialRadius = width/80;
    snakes = new SnakeCollection($canvas);
    for (var i=0 ; i<n ; i++) {
      var snake = new Snake();
      snake.x = width/2 - initialRadius + (i/2)*initialRadius*2/n;
      snake.radius = initialRadius;
      snakes.add(snake);
    }

    // Frame drawer
    var interval = setInterval(function() {
      snakes.next();


      frame++;
    }, 0);
  }
  
  var $canvas = $("canvas#canvastree");
  var canvas = $canvas[0];
  var context = canvas.getContext("2d");
  init();
  
});
