webpackJsonp([2],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]],\"env\":{\"test\":{\"presets\":[[\"env\",{\"targets\":{\"node\":\"current\"}}]]},\"development\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]},\"production\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]}}}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/js/frontend/components/AddlistingComponent.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
				data: function data() {
								return {
												success: false,
												loader: false,
												image: '',
												make: '',
												// formData: {},
												categories: {},
												makes: {},
												models: {},
												featured_image: '',
												listing: {
																title: '',
																description: '',
																make: 0,
																model: 0,
																category: 0,
																price: '',
																featured_image: '',
																offer: '',
																year: '',
																location: ''
												},
												errors: {}
								};
				},
				mounted: function mounted() {
								this.getCategories();
								this.getMakes();
				},

				methods: {
								getCategories: function getCategories() {
												var _this = this;

												window.axios.get('/category').then(function (response) {
																_this.categories = response.data;
												});
								},
								getMakes: function getMakes() {
												var _this2 = this;

												window.axios.get('/make').then(function (response) {
																_this2.makes = response.data;
												});
								},
								getModels: function getModels() {
												var _this3 = this;

												this.models = "";
												window.axios.get('/make/' + this.listing.make + '/models').then(function (response) {
																_this3.models = response.data;
												});
								},
								formSubmit: function formSubmit() {
												var _this4 = this;

												// let vm = this;
												//    window.axios.post('/account/listing', vm.listing)
												//    .then(function (response) {

												//    	vm.success = true;
												//    	vm.title = vm.listing.description =	vm.listing.make = vm.model = vm.listing.category = vm.listing.price = vm.listing.featured_image = vm.listing.offer = vm.listing.year = vm.listing.location = '';
												//    })
												//    .catch(function (error) {
												//       	console.log(error);
												//    });


												window.axios.post('/account/listing', this.listing).then(function (response) {
																// alert('Message sent!');
																_this4.success = true;
																_this4.listing.title = _this4.listing.description = _this4.listing.make = _this4.model = _this4.listing.category = _this4.listing.price = _this4.listing.featured_image = _this4.featured_image = _this4.listing.offer = _this4.listing.year = _this4.listing.location = _this4.image = '';
												}).catch(function (error) {
																if (error.response.status === 422) {
																				_this4.errors = error.response.data.errors || {};
																}
												});
								},

								// Image upload
								onImageChange: function onImageChange(e) {
												var files = e.target.files || e.dataTransfer.files;
												if (!files.length) return;
												this.createImage(files[0]);
								},
								createImage: function createImage(file) {
												var reader = new FileReader();
												var vm = this;
												reader.onload = function (e) {
																vm.image = e.target.result;
																vm.listing.featured_image = e.target.result;
												};
												reader.readAsDataURL(file);
								}
				}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]],\"env\":{\"test\":{\"presets\":[[\"env\",{\"targets\":{\"node\":\"current\"}}]]},\"development\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]},\"production\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]}}}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/js/frontend/components/EditlistingComponent.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
				props: ['slisting'],
				data: function data() {
								return {
												success: false,
												loader: false,
												image: this.slisting.featured_image,
												make: this.slisting.make_id,
												categories: {},
												makes: {},
												models: {},
												featured_image: '',
												listing: {
																title: this.slisting.title,
																description: this.slisting.description,
																make: this.slisting.make_id,
																model: this.slisting.model_id,
																category: this.slisting.category_id,
																price: this.slisting.price,
																featured_image: '',
																offer: this.slisting.is_offer,
																year: this.slisting.year,
																location: this.slisting.location
												},
												errors: {}
								};
				},
				mounted: function mounted() {
								this.getCategories();
								this.getMakes();
				},

				methods: {
								getCategories: function getCategories() {
												var _this = this;

												window.axios.get('/category').then(function (response) {
																_this.categories = response.data;
												});
								},
								getMakes: function getMakes() {
												var _this2 = this;

												window.axios.get('/make').then(function (response) {
																_this2.makes = response.data;
												});
								},
								getModels: function getModels() {
												var _this3 = this;

												this.models = "";
												window.axios.get('/make/' + this.listing.make + '/models').then(function (response) {
																_this3.models = response.data;
												});
								},
								formSubmit: function formSubmit() {
												var _this4 = this;

												window.axios.patch('/account/listing/' + this.slisting.id, this.listing).then(function (response) {
																_this4.success = true;
												}).catch(function (error) {
																if (error.response.status === 422) {
																				_this4.errors = error.response.data.errors || {};
																}
												});
								},

								// Image upload
								onImageChange: function onImageChange(e) {
												var files = e.target.files || e.dataTransfer.files;
												if (!files.length) return;
												this.createImage(files[0]);
								},
								createImage: function createImage(file) {
												var reader = new FileReader();
												var vm = this;
												reader.onload = function (e) {
																vm.image = e.target.result;
																vm.listing.featured_image = e.target.result;
												};
												reader.readAsDataURL(file);
								}
				}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]],\"env\":{\"test\":{\"presets\":[[\"env\",{\"targets\":{\"node\":\"current\"}}]]},\"development\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]},\"production\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]}}}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/js/frontend/components/ExampleComponent.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {
        console.log('Component mounted.');
    }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/component-normalizer.js":
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-0612d01d\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/js/frontend/components/EditlistingComponent.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "form",
    {
      attrs: { method: "post" },
      on: {
        submit: function($event) {
          $event.preventDefault()
          return _vm.formSubmit($event)
        }
      }
    },
    [
      _vm.success
        ? _c("div", { staticClass: "alert alert-success mt-3" }, [
            _vm._v(
              "\r\n\t       Suggestion submitted and will be published after review!\r\n\t"
            )
          ])
        : _vm._e(),
      _vm._v(" "),
      _c("div", { staticClass: "row" }, [
        _c(
          "div",
          {
            staticClass:
              "col-8 border border-2 border-left-0 border-top-0 border-bottom-0"
          },
          [
            _c("div", { staticClass: "card border-0" }, [
              _c("div", { staticClass: "card-body" }, [
                _c("div", { staticClass: "form-group" }, [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.listing.title,
                        expression: "listing.title"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text", placeholder: "Title" },
                    domProps: { value: _vm.listing.title },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.listing, "title", $event.target.value)
                      }
                    }
                  }),
                  _vm._v(" "),
                  _vm.errors && _vm.errors.title
                    ? _c("div", { staticClass: "text-danger" }, [
                        _vm._v(_vm._s(_vm.errors.title[0]))
                      ])
                    : _vm._e()
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "form-group" }, [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.listing.location,
                        expression: "listing.location"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text", placeholder: "Location" },
                    domProps: { value: _vm.listing.location },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.listing, "location", $event.target.value)
                      }
                    }
                  }),
                  _vm._v(" "),
                  _vm.errors && _vm.errors.location
                    ? _c("div", { staticClass: "text-danger" }, [
                        _vm._v(_vm._s(_vm.errors.location[0]))
                      ])
                    : _vm._e()
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col" }, [
                    _c("div", { staticClass: "form-group" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.listing.price,
                            expression: "listing.price"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { type: "text", placeholder: "Price" },
                        domProps: { value: _vm.listing.price },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(_vm.listing, "price", $event.target.value)
                          }
                        }
                      }),
                      _vm._v(" "),
                      _vm.errors && _vm.errors.price
                        ? _c("div", { staticClass: "text-danger" }, [
                            _vm._v(_vm._s(_vm.errors.price[0]))
                          ])
                        : _vm._e()
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col" }, [
                    _c("div", { staticClass: "form-group" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.listing.year,
                            expression: "listing.year"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { type: "text", placeholder: "Year" },
                        domProps: { value: _vm.listing.year },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(_vm.listing, "year", $event.target.value)
                          }
                        }
                      }),
                      _vm._v(" "),
                      _vm.errors && _vm.errors.year
                        ? _c("div", { staticClass: "text-danger" }, [
                            _vm._v(_vm._s(_vm.errors.year[0]))
                          ])
                        : _vm._e()
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col" }, [
                    _c("div", { staticClass: "form-check form-check-inline" }, [
                      _c(
                        "label",
                        {
                          staticClass: "form-check-label",
                          attrs: { for: _vm.listing.offer }
                        },
                        [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.listing.offer,
                                expression: "listing.offer"
                              }
                            ],
                            staticClass: "form-check-input",
                            attrs: { type: "checkbox" },
                            domProps: {
                              checked: Array.isArray(_vm.listing.offer)
                                ? _vm._i(_vm.listing.offer, null) > -1
                                : _vm.listing.offer
                            },
                            on: {
                              change: function($event) {
                                var $$a = _vm.listing.offer,
                                  $$el = $event.target,
                                  $$c = $$el.checked ? true : false
                                if (Array.isArray($$a)) {
                                  var $$v = null,
                                    $$i = _vm._i($$a, $$v)
                                  if ($$el.checked) {
                                    $$i < 0 &&
                                      _vm.$set(
                                        _vm.listing,
                                        "offer",
                                        $$a.concat([$$v])
                                      )
                                  } else {
                                    $$i > -1 &&
                                      _vm.$set(
                                        _vm.listing,
                                        "offer",
                                        $$a
                                          .slice(0, $$i)
                                          .concat($$a.slice($$i + 1))
                                      )
                                  }
                                } else {
                                  _vm.$set(_vm.listing, "offer", $$c)
                                }
                              }
                            }
                          }),
                          _vm._v(" This is an offer")
                        ]
                      )
                    ])
                  ])
                ]),
                _vm._v(" "),
                _c("hr"),
                _vm._v(" "),
                _c("div", { staticClass: "form-group" }, [
                  _c("textarea", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.listing.description,
                        expression: "listing.description"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: {
                      name: "description",
                      rows: "10",
                      placeholder: "Description"
                    },
                    domProps: { value: _vm.listing.description },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(
                          _vm.listing,
                          "description",
                          $event.target.value
                        )
                      }
                    }
                  })
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "form-group" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-primary btn-lg",
                      attrs: { type: "submit" }
                    },
                    [
                      _vm.loader
                        ? _c("span", { staticClass: "loader" })
                        : _vm._e(),
                      _vm._v(" Update")
                    ]
                  )
                ])
              ])
            ])
          ]
        ),
        _vm._v(" "),
        _c("div", { staticClass: "col-4" }, [
          _c("div", { staticClass: "card border-0" }, [
            _c("div", { staticClass: "card-body" }, [
              _c("div", { staticClass: "form-group border-bottom" }, [
                _c("label", { staticClass: "h5" }, [_vm._v("Category")]),
                _vm._v(" "),
                _c(
                  "select",
                  {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.listing.category,
                        expression: "listing.category"
                      }
                    ],
                    staticClass: "custom-select",
                    attrs: { size: "3", name: "category" },
                    on: {
                      change: function($event) {
                        var $$selectedVal = Array.prototype.filter
                          .call($event.target.options, function(o) {
                            return o.selected
                          })
                          .map(function(o) {
                            var val = "_value" in o ? o._value : o.value
                            return val
                          })
                        _vm.$set(
                          _vm.listing,
                          "category",
                          $event.target.multiple
                            ? $$selectedVal
                            : $$selectedVal[0]
                        )
                      }
                    }
                  },
                  [
                    _c("option", { attrs: { selected: "" } }, [
                      _vm._v("Select Category")
                    ]),
                    _vm._v(" "),
                    _vm._l(_vm.categories, function(category) {
                      return _c(
                        "option",
                        { domProps: { value: category.id } },
                        [_vm._v(_vm._s(category.name))]
                      )
                    })
                  ],
                  2
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group mt-4 border-bottom" }, [
                _c("label", { staticClass: "h5" }, [_vm._v("Make")]),
                _vm._v(" "),
                _c(
                  "select",
                  {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.listing.make,
                        expression: "listing.make"
                      }
                    ],
                    staticClass: "custom-select",
                    attrs: { size: "3" },
                    on: {
                      change: [
                        function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.$set(
                            _vm.listing,
                            "make",
                            $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          )
                        },
                        function($event) {
                          _vm.getModels()
                        }
                      ],
                      onload: function($event) {
                        _vm.getModels()
                      }
                    }
                  },
                  [
                    _c("option", [_vm._v("Select Make")]),
                    _vm._v("}\r\n\t\t\t\t\t\t  \t"),
                    _vm._l(_vm.makes, function(make) {
                      return _c("option", { domProps: { value: make.id } }, [
                        _vm._v(_vm._s(make.name))
                      ])
                    })
                  ],
                  2
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group mt-4 border-bottom" }, [
                _c("label", { staticClass: "h5" }, [_vm._v("Model")]),
                _vm._v(" "),
                _c(
                  "select",
                  {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.listing.model,
                        expression: "listing.model"
                      }
                    ],
                    staticClass: "custom-select",
                    attrs: { size: "3" },
                    on: {
                      change: function($event) {
                        var $$selectedVal = Array.prototype.filter
                          .call($event.target.options, function(o) {
                            return o.selected
                          })
                          .map(function(o) {
                            var val = "_value" in o ? o._value : o.value
                            return val
                          })
                        _vm.$set(
                          _vm.listing,
                          "model",
                          $event.target.multiple
                            ? $$selectedVal
                            : $$selectedVal[0]
                        )
                      }
                    }
                  },
                  [
                    _c("option", { attrs: { selected: "" } }, [
                      _vm._v("Select Model")
                    ]),
                    _vm._v(" "),
                    _vm._l(_vm.models, function(model) {
                      return _c("option", { domProps: { value: model.id } }, [
                        _vm._v(_vm._s(model.name))
                      ])
                    })
                  ],
                  2
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group mt-4 border-bottom" }, [
                _c("label", { staticClass: "h5" }, [_vm._v("Featured Image")]),
                _vm._v(" "),
                _c("input", {
                  staticClass: "form-control",
                  attrs: { type: "file" },
                  on: { change: _vm.onImageChange }
                })
              ]),
              _vm._v(" "),
              _vm.image
                ? _c("div", { staticClass: "col-12" }, [
                    _c("img", {
                      staticClass: "img img-responsive",
                      staticStyle: { width: "100%" },
                      attrs: { src: _vm.image }
                    })
                  ])
                : _vm._e()
            ])
          ])
        ])
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0612d01d", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-36d3baed\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/js/frontend/components/ExampleComponent.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-header" }, [
        _c("i", { staticClass: "fas fa-code" }),
        _vm._v(" Example Vue Component\n    ")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "card-body" }, [
        _vm._v("\n        I'm an example Vue component!\n    ")
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-36d3baed", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-c20b9ea0\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/js/frontend/components/AddlistingComponent.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-12 col-sm-8 bg-secondary p-3 mb-5" }, [
    _vm.success
      ? _c("div", { staticClass: "alert alert-success mt-3" }, [
          _vm._v(
            "\n\t\t\t       Suggestion submitted and will be published after review!\n\t\t\t"
          )
        ])
      : _vm._e(),
    _vm._v(" "),
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-body" }, [
        _c(
          "form",
          {
            staticClass: "form form-horizontal",
            attrs: { method: "post" },
            on: {
              submit: function($event) {
                $event.preventDefault()
                return _vm.formSubmit($event)
              }
            }
          },
          [
            _c("div", { staticClass: "form-group" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.listing.title,
                    expression: "listing.title"
                  }
                ],
                staticClass: "form-control",
                attrs: { type: "text", placeholder: "Title" },
                domProps: { value: _vm.listing.title },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.listing, "title", $event.target.value)
                  }
                }
              }),
              _vm._v(" "),
              _vm.errors && _vm.errors.title
                ? _c("div", { staticClass: "text-danger" }, [
                    _vm._v(_vm._s(_vm.errors.title[0]))
                  ])
                : _vm._e()
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "form-group" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.listing.location,
                    expression: "listing.location"
                  }
                ],
                staticClass: "form-control",
                attrs: { type: "text", placeholder: "Location" },
                domProps: { value: _vm.listing.location },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.listing, "location", $event.target.value)
                  }
                }
              }),
              _vm._v(" "),
              _vm.errors && _vm.errors.location
                ? _c("div", { staticClass: "text-danger" }, [
                    _vm._v(_vm._s(_vm.errors.location[0]))
                  ])
                : _vm._e()
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-6 col-sm-4" }, [
                _c("div", { staticClass: "form-group" }, [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.listing.price,
                        expression: "listing.price"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text", placeholder: "Price" },
                    domProps: { value: _vm.listing.price },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.listing, "price", $event.target.value)
                      }
                    }
                  }),
                  _vm._v(" "),
                  _vm.errors && _vm.errors.price
                    ? _c("div", { staticClass: "text-danger" }, [
                        _vm._v(_vm._s(_vm.errors.price[0]))
                      ])
                    : _vm._e()
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-6 col-sm-4" }, [
                _c("div", { staticClass: "form-group" }, [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.listing.year,
                        expression: "listing.year"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text", placeholder: "Year" },
                    domProps: { value: _vm.listing.year },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.listing, "year", $event.target.value)
                      }
                    }
                  }),
                  _vm._v(" "),
                  _vm.errors && _vm.errors.year
                    ? _c("div", { staticClass: "text-danger" }, [
                        _vm._v(_vm._s(_vm.errors.year[0]))
                      ])
                    : _vm._e()
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-12 col-sm-4 mb-2 mb-sm-0" }, [
                _c("div", { staticClass: "form-check form-check-inline" }, [
                  _c(
                    "label",
                    {
                      staticClass: "form-check-label",
                      attrs: { for: _vm.listing.offer }
                    },
                    [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.listing.offer,
                            expression: "listing.offer"
                          }
                        ],
                        staticClass: "form-check-input",
                        attrs: { type: "checkbox" },
                        domProps: {
                          checked: Array.isArray(_vm.listing.offer)
                            ? _vm._i(_vm.listing.offer, null) > -1
                            : _vm.listing.offer
                        },
                        on: {
                          change: function($event) {
                            var $$a = _vm.listing.offer,
                              $$el = $event.target,
                              $$c = $$el.checked ? true : false
                            if (Array.isArray($$a)) {
                              var $$v = null,
                                $$i = _vm._i($$a, $$v)
                              if ($$el.checked) {
                                $$i < 0 &&
                                  _vm.$set(
                                    _vm.listing,
                                    "offer",
                                    $$a.concat([$$v])
                                  )
                              } else {
                                $$i > -1 &&
                                  _vm.$set(
                                    _vm.listing,
                                    "offer",
                                    $$a.slice(0, $$i).concat($$a.slice($$i + 1))
                                  )
                              }
                            } else {
                              _vm.$set(_vm.listing, "offer", $$c)
                            }
                          }
                        }
                      }),
                      _vm._v(" This is an offer")
                    ]
                  )
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-12 col-sm-6" }, [
                _c("div", { staticClass: "form-group" }, [
                  _c("label", { staticClass: "form-control-label" }, [
                    _vm._v("Category")
                  ]),
                  _vm._v(" "),
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.listing.category,
                          expression: "listing.category"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { name: "category" },
                      on: {
                        change: function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.$set(
                            _vm.listing,
                            "category",
                            $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          )
                        }
                      }
                    },
                    [
                      _c("option", { attrs: { value: "0" } }, [
                        _vm._v("Select Category")
                      ]),
                      _vm._v(" "),
                      _vm._l(_vm.categories, function(category) {
                        return _c(
                          "option",
                          { domProps: { value: category.id } },
                          [_vm._v(_vm._s(category.name))]
                        )
                      })
                    ],
                    2
                  )
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-12 col-sm-6" }, [
                _c("div", { staticClass: "form-group" }, [
                  _c("label", { staticClass: "form-control-label" }, [
                    _vm._v("Featutred Image")
                  ]),
                  _vm._v(" "),
                  _c("input", {
                    staticClass: "form-control form-control-file",
                    attrs: { type: "file" },
                    on: { change: _vm.onImageChange }
                  }),
                  _vm._v(" "),
                  _vm.image
                    ? _c("div", [
                        _c("img", {
                          staticClass: "img img-fluid",
                          attrs: { src: _vm.image }
                        })
                      ])
                    : _vm._e()
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-12 col-sm-6" }, [
                _c("div", { staticClass: "form-group" }, [
                  _c("label", { staticClass: "form-control-label" }, [
                    _vm._v("Make")
                  ]),
                  _vm._v(" "),
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.listing.make,
                          expression: "listing.make"
                        }
                      ],
                      staticClass: "form-control",
                      on: {
                        change: [
                          function($event) {
                            var $$selectedVal = Array.prototype.filter
                              .call($event.target.options, function(o) {
                                return o.selected
                              })
                              .map(function(o) {
                                var val = "_value" in o ? o._value : o.value
                                return val
                              })
                            _vm.$set(
                              _vm.listing,
                              "make",
                              $event.target.multiple
                                ? $$selectedVal
                                : $$selectedVal[0]
                            )
                          },
                          function($event) {
                            _vm.getModels()
                          }
                        ]
                      }
                    },
                    [
                      _c("option", { attrs: { value: "0" } }, [
                        _vm._v("Select Make")
                      ]),
                      _vm._v(" "),
                      _vm._l(_vm.makes, function(make) {
                        return _c("option", { domProps: { value: make.id } }, [
                          _vm._v(_vm._s(make.name))
                        ])
                      })
                    ],
                    2
                  )
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-12 col-sm-6" }, [
                _c("div", { staticClass: "form-group" }, [
                  _c("label", { staticClass: "form-control-label" }, [
                    _vm._v("Model")
                  ]),
                  _vm._v(" "),
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.listing.model,
                          expression: "listing.model"
                        }
                      ],
                      staticClass: "form-control",
                      on: {
                        change: function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.$set(
                            _vm.listing,
                            "model",
                            $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          )
                        }
                      }
                    },
                    [
                      _c(
                        "option",
                        { attrs: { value: "0", selected: "selected" } },
                        [_vm._v("Select Model")]
                      ),
                      _vm._v(" "),
                      _vm._l(_vm.models, function(model) {
                        return _c("option", { domProps: { value: model.id } }, [
                          _vm._v(_vm._s(model.name))
                        ])
                      })
                    ],
                    2
                  )
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "form-group" }, [
              _c("textarea", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.listing.description,
                    expression: "listing.description"
                  }
                ],
                staticClass: "form-control",
                attrs: {
                  name: "description",
                  rows: "10",
                  placeholder: "Description"
                },
                domProps: { value: _vm.listing.description },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.listing, "description", $event.target.value)
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "form-group" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-secondary btn-lg",
                  attrs: { type: "submit" }
                },
                [
                  _vm.loader ? _c("span", { staticClass: "loader" }) : _vm._e(),
                  _vm._v(" Publish")
                ]
              )
            ])
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-c20b9ea0", module.exports)
  }
}

/***/ }),

/***/ "./resources/js/bootstrap.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash__ = __webpack_require__("./node_modules/lodash/lodash.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_lodash__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_axios__ = __webpack_require__("./node_modules/axios/index.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_axios___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_axios__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_sweetalert2__ = __webpack_require__("./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_sweetalert2___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_sweetalert2__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_jquery__ = __webpack_require__("./node_modules/jquery/dist/jquery.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_jquery___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_jquery__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_popper_js_dist_umd_popper__ = __webpack_require__("./node_modules/popper.js/dist/umd/popper.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_popper_js_dist_umd_popper___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4_popper_js_dist_umd_popper__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_bootstrap__ = __webpack_require__("./node_modules/bootstrap/dist/js/bootstrap.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_bootstrap___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5_bootstrap__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__fortawesome_fontawesome_svg_core__ = __webpack_require__("./node_modules/@fortawesome/fontawesome-svg-core/index.es.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__fortawesome_free_brands_svg_icons__ = __webpack_require__("./node_modules/@fortawesome/free-brands-svg-icons/index.es.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__fortawesome_free_regular_svg_icons__ = __webpack_require__("./node_modules/@fortawesome/free-regular-svg-icons/index.es.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__fortawesome_free_solid_svg_icons__ = __webpack_require__("./node_modules/@fortawesome/free-solid-svg-icons/index.es.js");
/**
 * This bootstrap file is used for both frontend and backend
 */





 // Required for BS4


/**
 * Font Awesome >=5.1
 *
 * Is recommended import just the icons that you use, for decrease considerably the file size.
 * You can see at next link, how it works: https://github.com/FortAwesome/Font-Awesome/blob/master/UPGRADING.md#no-more-default-imports
 * Also you can import the icons separately on the frontend and backend
 */






__WEBPACK_IMPORTED_MODULE_6__fortawesome_fontawesome_svg_core__["library"].add(__WEBPACK_IMPORTED_MODULE_7__fortawesome_free_brands_svg_icons__["fab"], __WEBPACK_IMPORTED_MODULE_8__fortawesome_free_regular_svg_icons__["far"], __WEBPACK_IMPORTED_MODULE_9__fortawesome_free_solid_svg_icons__["fas"]);

// Kicks off the process of finding <i> tags and replacing with <svg>
__WEBPACK_IMPORTED_MODULE_6__fortawesome_fontawesome_svg_core__["dom"].watch();

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = __WEBPACK_IMPORTED_MODULE_3_jquery___default.a;
window.swal = __WEBPACK_IMPORTED_MODULE_2_sweetalert2___default.a;
window._ = __WEBPACK_IMPORTED_MODULE_0_lodash___default.a; // Lodash

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = __WEBPACK_IMPORTED_MODULE_1_axios___default.a;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

/***/ }),

/***/ "./resources/js/frontend/app.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__bootstrap__ = __webpack_require__("./resources/js/bootstrap.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__plugins__ = __webpack_require__("./resources/js/plugins.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__plugins___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__plugins__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_vue__ = __webpack_require__("./node_modules/vue/dist/vue.common.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_vue__);

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */





window.Vue = __WEBPACK_IMPORTED_MODULE_2_vue___default.a;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

__WEBPACK_IMPORTED_MODULE_2_vue___default.a.component('example-component', __webpack_require__("./resources/js/frontend/components/ExampleComponent.vue"));
// Vue.component('listings-component', require('./components/ListingsComponent.vue'));
__WEBPACK_IMPORTED_MODULE_2_vue___default.a.component('addlisting-component', __webpack_require__("./resources/js/frontend/components/AddlistingComponent.vue"));
__WEBPACK_IMPORTED_MODULE_2_vue___default.a.component('editlisting-component', __webpack_require__("./resources/js/frontend/components/EditlistingComponent.vue"));

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var app = new __WEBPACK_IMPORTED_MODULE_2_vue___default.a({
  el: '#app'
});

/***/ }),

/***/ "./resources/js/frontend/components/AddlistingComponent.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]],\"env\":{\"test\":{\"presets\":[[\"env\",{\"targets\":{\"node\":\"current\"}}]]},\"development\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]},\"production\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]}}}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/js/frontend/components/AddlistingComponent.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-c20b9ea0\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/js/frontend/components/AddlistingComponent.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\js\\frontend\\components\\AddlistingComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-c20b9ea0", Component.options)
  } else {
    hotAPI.reload("data-v-c20b9ea0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/js/frontend/components/EditlistingComponent.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]],\"env\":{\"test\":{\"presets\":[[\"env\",{\"targets\":{\"node\":\"current\"}}]]},\"development\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]},\"production\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]}}}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/js/frontend/components/EditlistingComponent.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-0612d01d\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/js/frontend/components/EditlistingComponent.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\js\\frontend\\components\\EditlistingComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0612d01d", Component.options)
  } else {
    hotAPI.reload("data-v-0612d01d", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/js/frontend/components/ExampleComponent.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]],\"env\":{\"test\":{\"presets\":[[\"env\",{\"targets\":{\"node\":\"current\"}}]]},\"development\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]},\"production\":{\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":\"> 2%\",\"uglify\":true}}]]}}}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/js/frontend/components/ExampleComponent.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-36d3baed\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/js/frontend/components/ExampleComponent.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\js\\frontend\\components\\ExampleComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-36d3baed", Component.options)
  } else {
    hotAPI.reload("data-v-36d3baed", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/js/plugins.js":
/***/ (function(module, exports) {

/**
 * Allows you to add data-method="METHOD to links to automatically inject a form
 * with the method on click
 *
 * Example: <a href="{{route('customers.destroy', $customer->id)}}"
 * data-method="delete" name="delete_item">Delete</a>
 *
 * Injects a form with that's fired on click of the link with a DELETE request.
 * Good because you don't have to dirty your HTML with delete forms everywhere.
 */
function addDeleteForms() {
    $('[data-method]').append(function () {
        if (!$(this).find('form').length > 0) {
            return "\n<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" + "<input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" + "<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" + '</form>\n';
        } else {
            return '';
        }
    }).attr('href', '#').attr('style', 'cursor:pointer;').attr('onclick', '$(this).find("form").submit();');
}

/**
 * Place any jQuery/helper plugins in here.
 */
$(function () {
    /**
     * Add the data-method="delete" forms to all delete links
     */
    addDeleteForms();

    /**
     * Disable all submit buttons once clicked
     */
    // $('form').submit(function () {
    //     $(this).find('input[type="submit"]').attr('disabled', true);
    //     $(this).find('button[type="submit"]').attr('disabled', true);
    //     return true;
    // });

    /**
     * Generic confirm form delete using Sweet Alert
     */
    $('body').on('submit', 'form[name=delete_item]', function (e) {
        e.preventDefault();

        var form = this;
        var link = $('a[data-method="delete"]');
        var cancel = link.attr('data-trans-button-cancel') ? link.attr('data-trans-button-cancel') : 'Cancel';
        var confirm = link.attr('data-trans-button-confirm') ? link.attr('data-trans-button-confirm') : 'Yes, delete';
        var title = link.attr('data-trans-title') ? link.attr('data-trans-title') : 'Are you sure you want to delete this item?';

        swal({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            type: 'warning'
        }).then(function (result) {
            result.value && form.submit();
        });
    }).on('click', 'a[name=confirm_item]', function (e) {
        /**
         * Generic 'are you sure' confirm box
         */
        e.preventDefault();

        var link = $(this);
        var title = link.attr('data-trans-title') ? link.attr('data-trans-title') : 'Are you sure you want to do this?';
        var cancel = link.attr('data-trans-button-cancel') ? link.attr('data-trans-button-cancel') : 'Cancel';
        var confirm = link.attr('data-trans-button-confirm') ? link.attr('data-trans-button-confirm') : 'Continue';

        swal({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            type: 'info'
        }).then(function (result) {
            result.value && window.location.assign(link.attr('href'));
        });
    });

    $(document).ready(function () {
        var docHeight = $(window).height();
        var footerHeight = $('#footer').height();
        var footerTop = $('#footer').position().top + footerHeight;

        if (footerTop < docHeight) $('#footer').css('margin-top', 25 + (docHeight - footerTop) + 'px');
    });
});

/***/ }),

/***/ "./resources/sass/backend/app.scss":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/frontend/app.scss":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/js/frontend/app.js");
__webpack_require__("./resources/sass/frontend/app.scss");
module.exports = __webpack_require__("./resources/sass/backend/app.scss");


/***/ })

},[0]);