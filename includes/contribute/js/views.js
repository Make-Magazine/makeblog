var contrib = contrib || {
	model: {},
	view: {},
	collection: {}
};


// The individual step
contrib.view.step = Backbone.View.extend({
	tagName: 'div',
	className: 'step',
	template: _.template( jQuery('#steps-template').html() ),

	render: function() {
		this.$el.html( this.model( this.model.JSON() ) );

		return this;
	}
});


// The list of steps
contrib.view.stepsList = Backbone.View.extend({
	el: '.steps-wrapper',

	initialize: function( initialSteps ) {
		this.collection = new contrib.collection.steps( initialSteps );
		this.render();
	},

	render: function() {
		this.collection.each( function( item ) {
			this.renderStep( item );
		}, this );
	},

	renderStep: function( item ) {
		var stepView = new contrib.view.step({
			model: item
		});
		this.$el.append( stepView.render().el );
	}
});