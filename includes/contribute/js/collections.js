var contrib = contrib || {
	model: {},
	view: {},
	collection: {}
};

contrib.collection.steps = Backbone.Collection.extend({
	model: contrib.model.step
});