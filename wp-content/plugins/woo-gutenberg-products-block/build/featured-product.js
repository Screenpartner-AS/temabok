this.wc=this.wc||{},this.wc.blocks=this.wc.blocks||{},this.wc.blocks["featured-product"]=function(e){function t(t){for(var n,a,s=t[0],i=t[1],l=t[2],d=0,p=[];d<s.length;d++)a=s[d],Object.prototype.hasOwnProperty.call(c,a)&&c[a]&&p.push(c[a][0]),c[a]=0;for(n in i)Object.prototype.hasOwnProperty.call(i,n)&&(e[n]=i[n]);for(u&&u(t);p.length;)p.shift()();return o.push.apply(o,l||[]),r()}function r(){for(var e,t=0;t<o.length;t++){for(var r=o[t],n=!0,s=1;s<r.length;s++){var i=r[s];0!==c[i]&&(n=!1)}n&&(o.splice(t--,1),e=a(a.s=r[0]))}return e}var n={},c={23:0},o=[];function a(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,a),r.l=!0,r.exports}a.m=e,a.c=n,a.d=function(e,t,r){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(a.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)a.d(r,n,function(t){return e[t]}.bind(null,n));return r},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="";var s=window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[],i=s.push.bind(s);s.push=t,s=s.slice();for(var l=0;l<s.length;l++)t(s[l]);var u=i;return o.push([353,0]),r()}({0:function(e,t){e.exports=window.wp.element},1:function(e,t){e.exports=window.wp.i18n},106:function(e,t,r){"use strict";var n=r(5),c=r.n(n),o=r(0),a=r(1),s=r(7),i=(r(10),r(34)),l=r(94),u=r(9),d=Object(u.createHigherOrderComponent)(e=>{class t extends o.Component{render(){const{selected:t}=this.props,r=null==t;return Object(o.createElement)(e,c()({},this.props,{selected:r?[]:[t]}))}}return t.defaultProps={selected:null},t},"withTransformSingleSelectToMultipleSelect"),p=r(204),b=r(24),m=r.n(b),g=r(25),h=r.n(g),O=r(26),j=r(27),w=Object(u.createHigherOrderComponent)(e=>{class t extends o.Component{constructor(){super(...arguments),m()(this,"state",{error:null,loading:!1,variations:{}}),m()(this,"loadVariations",()=>{const{products:e}=this.props,{loading:t,variations:r}=this.state;if(t)return;const n=this.getExpandedProduct();if(!n||r[n])return;const c=e.find(e=>e.id===n);c.variations&&0!==c.variations.length?(this.setState({loading:!0}),Object(O.g)(n).then(e=>{const t=e.map(e=>({...e,parent:n}));this.setState({variations:{...this.state.variations,[n]:t},loading:!1,error:null})}).catch(async e=>{const t=await Object(j.a)(e);this.setState({variations:{...this.state.variations,[n]:null},loading:!1,error:t})})):this.setState({variations:{...this.state.variations,[n]:null},loading:!1,error:null})})}componentDidMount(){const{selected:e,showVariations:t}=this.props;e&&t&&this.loadVariations()}componentDidUpdate(e){const{isLoading:t,selected:r,showVariations:n}=this.props;n&&(!h()(e.selected,r)||e.isLoading&&!t)&&this.loadVariations()}isProductId(e){const{products:t}=this.props;return t.some(t=>t.id===e)}findParentProduct(e){const{products:t}=this.props;return t.filter(t=>t.variations&&t.variations.find(t=>{let{id:r}=t;return r===e}))[0].id}getExpandedProduct(){const{isLoading:e,selected:t,showVariations:r}=this.props;if(!r)return null;let n=t&&t.length?t[0]:null;return n?this.prevSelectedItem=n:this.prevSelectedItem&&(e||this.isProductId(this.prevSelectedItem)||(n=this.prevSelectedItem)),!e&&n?this.isProductId(n)?n:this.findParentProduct(n):null}render(){const{error:t,isLoading:r}=this.props,{error:n,loading:a,variations:s}=this.state;return Object(o.createElement)(e,c()({},this.props,{error:n||t,expandedProduct:this.getExpandedProduct(),isLoading:r,variations:s,variationsLoading:a}))}}return m()(t,"defaultProps",{selected:[],showVariations:!1}),t},"withProductVariations"),f=r(33),_=r(4),v=r.n(_),k=r(96);r(151);const E={list:Object(a.__)("Products","woo-gutenberg-products-block"),noItems:Object(a.__)("Your store doesn't have any products.","woo-gutenberg-products-block"),search:Object(a.__)("Search for a product to display","woo-gutenberg-products-block"),updated:Object(a.__)("Product search results updated.","woo-gutenberg-products-block")},S=e=>{let{expandedProduct:t,error:r,instanceId:n,isCompact:u,isLoading:d,onChange:p,onSearch:b,products:m,renderItem:g,selected:h,showVariations:O,variations:j,variationsLoading:w}=e;if(r)return Object(o.createElement)(f.a,{error:r});const _=[...m,...j&&j[t]?j[t]:[]];return Object(o.createElement)(l.a,{className:"woocommerce-products",list:_,isCompact:u,isLoading:d,isSingle:!0,selected:_.filter(e=>{let{id:t}=e;return h.includes(t)}),onChange:p,renderItem:g||(O?e=>{const{item:t,search:r,depth:l=0,isSelected:u,onSelect:p}=e,b=t.variations&&Array.isArray(t.variations)?t.variations.length:0,m=v()("woocommerce-search-product__item","woocommerce-search-list__item","depth-"+l,"has-count",{"is-searching":r.length>0,"is-skip-level":0===l&&0!==t.parent,"is-variable":b>0});if(!t.breadcrumbs.length)return Object(o.createElement)(k.a,c()({},e,{className:v()(m,{"is-selected":u}),isSelected:u,item:t,onSelect:()=>()=>{p(t)()},isLoading:d||w,countLabel:t.variations.length>0?Object(a.sprintf)(
/* translators: %1$d is the number of variations of a product product. */
Object(a.__)("%1$d variations","woo-gutenberg-products-block"),t.variations.length):null,name:"products-"+n,"aria-label":Object(a.sprintf)(
/* translators: %1$s is the product name, %2$d is the number of variations of that product. */
Object(a._n)("%1$s, has %2$d variation","%1$s, has %2$d variations",t.variations.length,"woo-gutenberg-products-block"),t.name,t.variations.length)}));const g=Object(s.isEmpty)(t.variation)?e:{...e,item:{...e.item,name:t.variation},"aria-label":`${t.breadcrumbs[0]}: ${t.variation}`};return Object(o.createElement)(i.a,c()({},g,{className:m,name:"variations-"+n}))}:null),onSearch:b,messages:E,isHierarchical:!0})};S.defaultProps={isCompact:!1,expandedProduct:null,selected:[],showVariations:!1},t.a=d(Object(p.a)(w(Object(u.withInstanceId)(S))))},109:function(e,t){},11:function(e,t){e.exports=window.wp.primitives},12:function(e,t){e.exports=window.wp.apiFetch},13:function(e,t){e.exports=window.wp.blocks},137:function(e,t,r){"use strict";var n=r(5),c=r.n(n),o=r(0),a=r(3),s=r(4),i=r.n(s);r(173),t.a=function(e){let{className:t="",...r}=e;const n=i()("wc-block-text-toolbar-button",t);return Object(o.createElement)(a.Button,c()({className:n},r))}},14:function(e,t){e.exports=window.wp.data},151:function(e,t){},17:function(e,t){e.exports=window.wp.htmlEntities},173:function(e,t){},18:function(e,t){e.exports=window.wp.url},2:function(e,t){e.exports=window.wc.wcSettings},20:function(e,t,r){"use strict";r.d(t,"a",(function(){return a})),r.d(t,"c",(function(){return i})),r.d(t,"d",(function(){return l})),r.d(t,"b",(function(){return u}));var n=r(0),c=r(7),o=r(1);const a={clear:Object(o.__)("Clear all selected items","woo-gutenberg-products-block"),noItems:Object(o.__)("No items found.","woo-gutenberg-products-block"),
/* Translators: %s search term */
noResults:Object(o.__)("No results for %s","woo-gutenberg-products-block"),search:Object(o.__)("Search for items","woo-gutenberg-products-block"),selected:e=>Object(o.sprintf)(
/* translators: Number of items selected from list. */
Object(o._n)("%d item selected","%d items selected",e,"woo-gutenberg-products-block"),e),updated:Object(o.__)("Search results updated.","woo-gutenberg-products-block")},s=function(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:e;const r=Object(c.groupBy)(e,"parent"),n=Object(c.keyBy)(t,"id"),o=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};if(!e.parent)return e.name?[e.name]:[];const t=o(n[e.parent]);return[...t,e.name]},a=e=>e.map(e=>{const t=r[e.id];return delete r[e.id],{...e,breadcrumbs:o(n[e.parent]),children:t&&t.length?a(t):[]}}),s=a(r[0]||[]);return delete r[0],Object(c.forEach)(r,e=>{s.push(...a(e||[]))}),s},i=(e,t,r)=>{if(!t)return r?s(e):e;const n=new RegExp(t.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"),"i"),c=e.map(e=>!!n.test(e.name)&&e).filter(Boolean);return r?s(c,e):c},l=(e,t)=>{if(!t)return e;const r=new RegExp(t.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"),"ig");return e.split(r).map((e,r)=>0===r?e:Object(n.createElement)(n.Fragment,{key:r},Object(n.createElement)("strong",null,t),e))},u=e=>1===e.length?e.slice(0,1).toString():2===e.length?e.slice(0,1).toString()+" › "+e.slice(-1).toString():e.slice(0,1).toString()+" … "+e.slice(-1).toString()},204:function(e,t,r){"use strict";var n=r(5),c=r.n(n),o=r(0),a=r(22),s=r(26),i=r(119),l=r(27);t.a=e=>t=>{let{selected:r,...n}=t;const[u,d]=Object(o.useState)(!0),[p,b]=Object(o.useState)(null),[m,g]=Object(o.useState)([]),h=a.o.productCount>100,O=async e=>{const t=await Object(l.a)(e);b(t),d(!1)},j=Object(o.useRef)(r);Object(o.useEffect)(()=>{Object(s.h)({selected:j.current}).then(e=>{g(e),d(!1)}).catch(O)},[j]);const w=Object(i.a)(e=>{Object(s.h)({selected:r,search:e}).then(e=>{g(e),d(!1)}).catch(O)},400),f=Object(o.useCallback)(e=>{d(!0),w(e)},[d,w]);return Object(o.createElement)(e,c()({},n,{selected:r,error:p,products:m,isLoading:u,onSearch:h?f:null}))}},22:function(e,t,r){"use strict";r.d(t,"o",(function(){return o})),r.d(t,"m",(function(){return a})),r.d(t,"l",(function(){return s})),r.d(t,"n",(function(){return i})),r.d(t,"j",(function(){return l})),r.d(t,"e",(function(){return u})),r.d(t,"f",(function(){return d})),r.d(t,"g",(function(){return p})),r.d(t,"k",(function(){return b})),r.d(t,"c",(function(){return m})),r.d(t,"d",(function(){return g})),r.d(t,"h",(function(){return h})),r.d(t,"a",(function(){return O})),r.d(t,"i",(function(){return j})),r.d(t,"b",(function(){return w}));var n,c=r(2);const o=Object(c.getSetting)("wcBlocksConfig",{buildPhase:1,pluginUrl:"",productCount:0,defaultAvatar:"",restApiRoutes:{},wordCountType:"words"}),a=o.pluginUrl+"images/",s=o.pluginUrl+"build/",i=o.buildPhase,l=null===(n=c.STORE_PAGES.shop)||void 0===n?void 0:n.permalink,u=c.STORE_PAGES.checkout.id,d=c.STORE_PAGES.checkout.permalink,p=c.STORE_PAGES.privacy.permalink,b=(c.STORE_PAGES.privacy.title,c.STORE_PAGES.terms.permalink),m=(c.STORE_PAGES.terms.title,c.STORE_PAGES.cart.id),g=c.STORE_PAGES.cart.permalink,h=(c.STORE_PAGES.myaccount.permalink?c.STORE_PAGES.myaccount.permalink:Object(c.getSetting)("wpLoginUrl","/wp-login.php"),Object(c.getSetting)("shippingCountries",{})),O=Object(c.getSetting)("allowedCountries",{}),j=Object(c.getSetting)("shippingStates",{}),w=Object(c.getSetting)("allowedStates",{})},25:function(e,t){e.exports=window.wp.isShallowEqual},26:function(e,t,r){"use strict";r.d(t,"h",(function(){return l})),r.d(t,"e",(function(){return u})),r.d(t,"b",(function(){return d})),r.d(t,"i",(function(){return p})),r.d(t,"f",(function(){return b})),r.d(t,"c",(function(){return m})),r.d(t,"d",(function(){return g})),r.d(t,"g",(function(){return h})),r.d(t,"a",(function(){return O}));var n=r(18),c=r(12),o=r.n(c),a=r(7),s=r(2),i=r(22);const l=e=>{let{selected:t=[],search:r="",queryArgs:c={}}=e;const s=(e=>{let{selected:t=[],search:r="",queryArgs:c={}}=e;const o=i.o.productCount>100,a={per_page:o?100:0,catalog_visibility:"any",search:r,orderby:"title",order:"asc"},s=[Object(n.addQueryArgs)("/wc/store/v1/products",{...a,...c})];return o&&t.length&&s.push(Object(n.addQueryArgs)("/wc/store/v1/products",{catalog_visibility:"any",include:t,per_page:0})),s})({selected:t,search:r,queryArgs:c});return Promise.all(s.map(e=>o()({path:e}))).then(e=>Object(a.uniqBy)(Object(a.flatten)(e),"id").map(e=>({...e,parent:0}))).catch(e=>{throw e})},u=e=>o()({path:"/wc/store/v1/products/"+e}),d=()=>o()({path:"wc/store/v1/products/attributes"}),p=e=>o()({path:`wc/store/v1/products/attributes/${e}/terms`}),b=e=>{let{selected:t=[],search:r}=e;const c=(e=>{let{selected:t=[],search:r}=e;const c=Object(s.getSetting)("limitTags",!1),o=[Object(n.addQueryArgs)("wc/store/v1/products/tags",{per_page:c?100:0,orderby:c?"count":"name",order:c?"desc":"asc",search:r})];return c&&t.length&&o.push(Object(n.addQueryArgs)("wc/store/v1/products/tags",{include:t})),o})({selected:t,search:r});return Promise.all(c.map(e=>o()({path:e}))).then(e=>Object(a.uniqBy)(Object(a.flatten)(e),"id"))},m=e=>o()({path:Object(n.addQueryArgs)("wc/store/v1/products/categories",{per_page:0,...e})}),g=e=>o()({path:"wc/store/v1/products/categories/"+e}),h=e=>o()({path:Object(n.addQueryArgs)("wc/store/v1/products",{per_page:0,type:"variation",parent:e})}),O=(e,t)=>{if(!e.title.raw)return e.slug;const r=1===t.filter(t=>t.title.raw===e.title.raw).length;return e.title.raw+(r?"":" - "+e.slug)}},268:function(e,t,r){"use strict";var n=r(5),c=r.n(n),o=r(24),a=r.n(o),s=r(0),i=r(9),l=r(26),u=r(27);const d=Object(i.createHigherOrderComponent)(e=>class extends s.Component{constructor(){super(...arguments),a()(this,"state",{error:null,loading:!1,product:"preview"===this.props.attributes.productId?this.props.attributes.previewProduct:null}),a()(this,"loadProduct",()=>{const{productId:e}=this.props.attributes;"preview"!==e&&(e?(this.setState({loading:!0}),Object(l.e)(e).then(e=>{this.setState({product:e,loading:!1,error:null})}).catch(async e=>{const t=await Object(u.a)(e);this.setState({product:null,loading:!1,error:t})})):this.setState({product:null,loading:!1,error:null}))})}componentDidMount(){this.loadProduct()}componentDidUpdate(e){e.attributes.productId!==this.props.attributes.productId&&this.loadProduct()}render(){const{error:t,loading:r,product:n}=this.state;return Object(s.createElement)(e,c()({},this.props,{error:t,getProduct:this.loadProduct,isLoading:r,product:n}))}},"withProduct");t.a=d},27:function(e,t,r){"use strict";r.d(t,"a",(function(){return c})),r.d(t,"b",(function(){return o}));var n=r(1);const c=async e=>{if("function"==typeof e.json)try{const t=await e.json();return{message:t.message,type:t.type||"api"}}catch(e){return{message:e.message,type:"general"}}return{message:e.message,type:e.type||"general"}},o=e=>{if(e.data&&"rest_invalid_param"===e.code){const t=Object.values(e.data.params);if(t[0])return t[0]}return(null==e?void 0:e.message)||Object(n.__)("Something went wrong. Please contact us to get assistance.","woo-gutenberg-products-block")}},3:function(e,t){e.exports=window.wp.components},31:function(e,t){e.exports=window.wp.escapeHtml},33:function(e,t,r){"use strict";var n=r(0),c=r(1),o=r(31);t.a=e=>{let{error:t}=e;return Object(n.createElement)("div",{className:"wc-block-error-message"},(e=>{let{message:t,type:r}=e;return t?"general"===r?Object(n.createElement)("span",null,Object(c.__)("The following error was returned","woo-gutenberg-products-block"),Object(n.createElement)("br",null),Object(n.createElement)("code",null,Object(o.escapeHTML)(t))):"api"===r?Object(n.createElement)("span",null,Object(c.__)("The following error was returned from the API","woo-gutenberg-products-block"),Object(n.createElement)("br",null),Object(n.createElement)("code",null,Object(o.escapeHTML)(t))):t:Object(c.__)("An unknown error occurred which prevented the block from being updated.","woo-gutenberg-products-block")})(t))}},34:function(e,t,r){"use strict";r.d(t,"a",(function(){return s}));var n=r(5),c=r.n(n),o=r(0),a=r(20);const s=e=>{let{countLabel:t,className:r,depth:n=0,controlId:s="",item:i,isSelected:l,isSingle:u,onSelect:d,search:p="",...b}=e;const m=null!=t&&void 0!==i.count&&null!==i.count,g=[r,"woocommerce-search-list__item"];g.push("depth-"+n),u&&g.push("is-radio-button"),m&&g.push("has-count");const h=i.breadcrumbs&&i.breadcrumbs.length,O=b.name||"search-list-item-"+s,j=`${O}-${i.id}`;return Object(o.createElement)("label",{htmlFor:j,className:g.join(" ")},u?Object(o.createElement)("input",c()({type:"radio",id:j,name:O,value:i.value,onChange:d(i),checked:l,className:"woocommerce-search-list__item-input"},b)):Object(o.createElement)("input",c()({type:"checkbox",id:j,name:O,value:i.value,onChange:d(i),checked:l,className:"woocommerce-search-list__item-input"},b)),Object(o.createElement)("span",{className:"woocommerce-search-list__item-label"},h?Object(o.createElement)("span",{className:"woocommerce-search-list__item-prefix"},Object(a.b)(i.breadcrumbs)):null,Object(o.createElement)("span",{className:"woocommerce-search-list__item-name"},Object(a.d)(i.name,p))),!!m&&Object(o.createElement)("span",{className:"woocommerce-search-list__item-count"},t||i.count))};t.b=s},353:function(e,t,r){e.exports=r(454)},354:function(e,t){},355:function(e,t,r){"use strict";r.d(t,"a",(function(){return o}));var n=r(1),c=r(22);const o=[{id:1,name:"WordPress Pennant",variation:"",permalink:"https://example.org",sku:"wp-pennant",short_description:Object(n.__)("Fly your WordPress banner with this beauty! Deck out your office space or add it to your kids walls. This banner will spruce up any space it’s hung!","woo-gutenberg-products-block"),description:"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.",price:"7.99",price_html:'<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>7.99</span>',images:[{id:1,src:c.m+"previews/pennant.jpg",thumbnail:c.m+"previews/pennant.jpg",name:"pennant-1.jpg",alt:"WordPress Pennant",srcset:"",sizes:""}],average_rating:5,categories:[{id:1,name:"Decor",slug:"decor",link:"https://example.org"}],review_count:1,prices:{currency_code:"GBP",decimal_separator:".",thousand_separator:",",decimals:2,price_prefix:"£",price_suffix:"",price:"7.99",regular_price:"9.99",sale_price:"7.99",price_range:null},add_to_cart:{text:Object(n.__)("Add to cart","woo-gutenberg-products-block"),description:Object(n.__)("Add to cart","woo-gutenberg-products-block")},has_options:!1,is_purchasable:!0,is_in_stock:!0,on_sale:!0}]},356:function(e,t){},454:function(e,t,r){"use strict";r.r(t);var n=r(0),c=r(1),o=r(6),a=r(13),s=r(2),i=r(55),l=r(108),u=r(496),d=(r(354),r(355));const p={attributes:{contentAlign:"center",dimRatio:50,editMode:!1,height:Object(s.getSetting)("default_height",500),mediaSrc:"",showDesc:!0,productId:"preview",previewProduct:d.a[0]}};var b=r(5),m=r.n(b),g=r(24),h=r.n(g),O=r(14),j=r(3),w=r(4),f=r.n(w),_=r(9),v=r(7),k=(r(10),r(106)),E=r(75),S=r(137),y=r(268);function P(e){return e&&e.images&&e.images.length&&e.images[0].src||""}var x=Object(_.compose)([y.a,j.withSpokenMessages,Object(O.withSelect)((e,t,r)=>{var n,c;let{clientId:o}=t,{dispatch:a}=r;const s=e("core/block-editor").getBlock(o),i=(null==s||null===(n=s.innerBlocks[0])||void 0===n?void 0:n.clientId)||"";return{updateBlockAttributes:e=>{i&&a("core/block-editor").updateBlockAttributes(i,e)},currentButtonAttributes:(null==s||null===(c=s.innerBlocks[0])||void 0===c?void 0:c.attributes)||{}}}),Object(_.createHigherOrderComponent)(e=>{class t extends n.Component{constructor(){super(...arguments),h()(this,"state",{doUrlUpdate:!1}),h()(this,"triggerUrlUpdate",()=>{this.setState({doUrlUpdate:!0})})}componentDidUpdate(){const{attributes:e,updateBlockAttributes:t,currentButtonAttributes:r,product:n}=this.props;this.state.doUrlUpdate&&!e.editMode&&null!=n&&n.permalink&&null!=r&&r.url&&n.permalink!==r.url&&(t({...r,url:n.permalink}),this.setState({doUrlUpdate:!1}))}render(){return Object(n.createElement)(e,m()({triggerUrlUpdate:this.triggerUrlUpdate},this.props))}}return t},"withUpdateButtonAttributes")])(e=>{let{attributes:t,debouncedSpeak:r,error:a,getProduct:i,isLoading:d,isSelected:p,product:b,setAttributes:m,triggerUrlUpdate:g=(()=>{})}=e;const h=()=>{const{contentAlign:e,editMode:r,mediaSrc:a}=t,s=t.mediaId||function(e){return e&&e.images&&e.images.length&&e.images[0].id||0}(b);return Object(n.createElement)(o.BlockControls,null,Object(n.createElement)(o.AlignmentToolbar,{value:e,onChange:e=>{m({contentAlign:e})}}),Object(n.createElement)(j.ToolbarGroup,null,Object(n.createElement)(o.MediaReplaceFlow,{mediaId:s,mediaURL:a,accept:"image/*",onSelect:e=>{m({mediaId:e.id,mediaSrc:e.url})},allowedTypes:["image"]}),s&&a?Object(n.createElement)(S.a,{onClick:()=>m({mediaId:0,mediaSrc:""})},Object(c.__)("Reset","woo-gutenberg-products-block")):null),Object(n.createElement)(j.ToolbarGroup,{controls:[{icon:"edit",title:Object(c.__)("Edit selected product","woo-gutenberg-products-block"),onClick:()=>m({editMode:!r}),isActive:r}]}))},{editMode:O}=t;return a?Object(n.createElement)(E.a,{className:"wc-block-featured-product-error",error:a,isLoading:d,onRetry:i}):O?Object(n.createElement)(n.Fragment,null,h(),Object(n.createElement)(j.Placeholder,{icon:Object(n.createElement)(l.a,{icon:u.a}),label:Object(c.__)("Featured Product","woo-gutenberg-products-block"),className:"wc-block-featured-product"},Object(c.__)("Visually highlight a product or variation and encourage prompt action","woo-gutenberg-products-block"),Object(n.createElement)("div",{className:"wc-block-featured-product__selection"},Object(n.createElement)(k.a,{selected:t.productId||0,showVariations:!0,onChange:function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];const t=e[0]?e[0].id:0;m({productId:t,mediaId:0,mediaSrc:""}),g()}}),Object(n.createElement)(j.Button,{isPrimary:!0,onClick:()=>{m({editMode:!1}),r(Object(c.__)("Showing Featured Product block preview.","woo-gutenberg-products-block"))}},Object(c.__)("Done","woo-gutenberg-products-block"))))):Object(n.createElement)(n.Fragment,null,h(),(()=>{const e=t.mediaSrc||P(b),{focalPoint:r={x:.5,y:.5}}=t,a="function"==typeof j.FocalPointPicker;return Object(n.createElement)(o.InspectorControls,{key:"inspector"},Object(n.createElement)(j.PanelBody,{title:Object(c.__)("Content","woo-gutenberg-products-block")},Object(n.createElement)(j.ToggleControl,{label:Object(c.__)("Show description","woo-gutenberg-products-block"),checked:t.showDesc,onChange:()=>m({showDesc:!t.showDesc})}),Object(n.createElement)(j.ToggleControl,{label:Object(c.__)("Show price","woo-gutenberg-products-block"),checked:t.showPrice,onChange:()=>m({showPrice:!t.showPrice})})),!!e&&Object(n.createElement)(n.Fragment,null,Object(n.createElement)(j.PanelBody,{title:Object(c.__)("Overlay","woo-gutenberg-products-block")},Object(n.createElement)(j.RangeControl,{label:Object(c.__)("Background Opacity","woo-gutenberg-products-block"),value:t.dimRatio,onChange:e=>m({dimRatio:e}),min:0,max:100,step:10}),a&&Object(n.createElement)(j.FocalPointPicker,{label:Object(c.__)("Focal Point Picker","woo-gutenberg-products-block"),url:e,value:r,onChange:e=>m({focalPoint:e})}))))})(),b?(()=>{const{contentAlign:e,dimRatio:r,focalPoint:a,height:i,showDesc:l,showPrice:u}=t,g=f()("wc-block-featured-product",{"is-selected":p&&"preview"!==t.productId,"is-loading":!b&&d,"is-not-found":!b&&!d,"has-background-dim":0!==r},0===(h=r)||50===h?null:"has-background-dim-"+10*Math.round(h/10),"center"!==e&&`has-${e}-content`);var h;const O=(w=t.mediaSrc||b,Object(v.isObject)(w)&&(w=P(w)),w?{backgroundImage:`url(${w})`}:{});var w;if(a){const e=100*a.x,t=100*a.y;O.backgroundPosition=`${e}% ${t}%`}return Object(n.createElement)(j.ResizableBox,{className:g,size:{height:i},minHeight:Object(s.getSetting)("min_height",500),enable:{bottom:!0},onResizeStop:(e,t,r)=>{m({height:parseInt(r.style.height,10)})},style:O},Object(n.createElement)("div",{className:"wc-block-featured-product__wrapper"},Object(n.createElement)("h2",{className:"wc-block-featured-product__title",dangerouslySetInnerHTML:{__html:b.name}}),!Object(v.isEmpty)(b.variation)&&Object(n.createElement)("h3",{className:"wc-block-featured-product__variation",dangerouslySetInnerHTML:{__html:b.variation}}),l&&Object(n.createElement)("div",{className:"wc-block-featured-product__description",dangerouslySetInnerHTML:{__html:b.short_description}}),u&&Object(n.createElement)("div",{className:"wc-block-featured-product__price",dangerouslySetInnerHTML:{__html:b.price_html}}),Object(n.createElement)("div",{className:"wc-block-featured-product__link"},(()=>{const e=f()("wp-block-button__link","is-style-fill");return"preview"===t.productId?Object(n.createElement)("div",{className:"wp-block-button aligncenter",style:{width:"100%"}},Object(n.createElement)(o.RichText.Content,{tagName:"a",className:e,href:b.permalink,title:t.linkText,style:{backgroundColor:"vivid-green-cyan",borderRadius:"5px"},value:t.linkText,target:b.permalink})):Object(n.createElement)(o.InnerBlocks,{template:[["core/buttons",{},[["core/button",{text:Object(c.__)("Shop now","woo-gutenberg-products-block"),url:b.permalink,align:"center"}]]]],templateLock:"all"})})())))})():Object(n.createElement)(j.Placeholder,{className:"wc-block-featured-product",icon:Object(n.createElement)(l.a,{icon:u.a}),label:Object(c.__)("Featured Product","woo-gutenberg-products-block")},d?Object(n.createElement)(j.Spinner,null):Object(c.__)("No product is selected.","woo-gutenberg-products-block")))});r(356),Object(a.registerBlockType)("woocommerce/featured-product",{apiVersion:2,title:Object(c.__)("Featured Product","woo-gutenberg-products-block"),icon:{src:Object(n.createElement)(l.a,{icon:u.a,className:"wc-block-editor-components-block-icon"})},category:"woocommerce",keywords:[Object(c.__)("WooCommerce","woo-gutenberg-products-block")],description:Object(c.__)("Visually highlight a product or variation and encourage prompt action.","woo-gutenberg-products-block"),supports:{align:["wide","full"],html:!1,color:!0,...Object(i.b)()&&{__experimentalBorder:{color:!0,radius:!0,width:!0,__experimentalSkipSerialization:!1}}},example:p,attributes:{contentAlign:{type:"string",default:"center"},dimRatio:{type:"number",default:50},editMode:{type:"boolean",default:!0},focalPoint:{type:"object"},height:{type:"number",default:Object(s.getSetting)("default_height",500)},mediaId:{type:"number",default:0},mediaSrc:{type:"string",default:""},overlayColor:{type:"string"},customOverlayColor:{type:"string"},linkText:{type:"string",default:Object(c.__)("Shop now","woo-gutenberg-products-block")},productId:{type:"number"},showDesc:{type:"boolean",default:!0},showPrice:{type:"boolean",default:!0},previewProduct:{type:"object",default:null}},edit:e=>{const t=Object(o.useBlockProps)();return Object(n.createElement)("div",t,Object(n.createElement)(x,e))},save:()=>Object(n.createElement)(o.InnerBlocks.Content,null)})},55:function(e,t,r){"use strict";r.d(t,"c",(function(){return o})),r.d(t,"d",(function(){return a})),r.d(t,"a",(function(){return s})),r.d(t,"b",(function(){return i}));var n=r(13),c=r(22);const o=(e,t)=>{if(c.n>2)return Object(n.registerBlockType)(e,t)},a=(e,t)=>{if(c.n>1)return Object(n.registerBlockType)(e,t)},s=()=>c.n>2,i=()=>c.n>1},6:function(e,t){e.exports=window.wp.blockEditor},7:function(e,t){e.exports=window.lodash},75:function(e,t,r){"use strict";var n=r(0),c=r(1),o=r(108),a=r(168),s=r(4),i=r.n(s),l=r(3),u=r(33);r(109),t.a=e=>{let{className:t,error:r,isLoading:s=!1,onRetry:d}=e;return Object(n.createElement)(l.Placeholder,{icon:Object(n.createElement)(o.a,{icon:a.a}),label:Object(c.__)("Sorry, an error occurred","woo-gutenberg-products-block"),className:i()("wc-block-api-error",t)},Object(n.createElement)(u.a,{error:r}),d&&Object(n.createElement)(n.Fragment,null,s?Object(n.createElement)(l.Spinner,null):Object(n.createElement)(l.Button,{isSecondary:!0,onClick:d},Object(c.__)("Retry","woo-gutenberg-products-block"))))}},8:function(e,t){e.exports=window.React},9:function(e,t){e.exports=window.wp.compose},94:function(e,t,r){"use strict";r.d(t,"a",(function(){return k}));var n=r(5),c=r.n(n),o=r(0),a=r(1),s=r(3),i=r(108),l=r(489),u=r(4),d=r.n(u),p=r(9),b=r(20),m=r(34),g=r(488),h=r(17);const O=e=>{let{id:t,label:r,popoverContents:n,remove:c,screenReaderLabel:l,className:u=""}=e;const[b,m]=Object(o.useState)(!1),j=Object(p.useInstanceId)(O);if(l=l||r,!r)return null;r=Object(h.decodeEntities)(r);const w=d()("woocommerce-tag",u,{"has-remove":!!c}),f="woocommerce-tag__label-"+j,_=Object(o.createElement)(o.Fragment,null,Object(o.createElement)("span",{className:"screen-reader-text"},l),Object(o.createElement)("span",{"aria-hidden":"true"},r));return Object(o.createElement)("span",{className:w},n?Object(o.createElement)(s.Button,{className:"woocommerce-tag__text",id:f,onClick:()=>m(!0)},_):Object(o.createElement)("span",{className:"woocommerce-tag__text",id:f},_),n&&b&&Object(o.createElement)(s.Popover,{onClose:()=>m(!1)},n),c&&Object(o.createElement)(s.Button,{className:"woocommerce-tag__remove",onClick:c(t),label:Object(a.sprintf)(// Translators: %s label.
Object(a.__)("Remove %s","woo-gutenberg-products-block"),r),"aria-describedby":f},Object(o.createElement)(i.a,{icon:g.a,size:20,className:"clear-icon"})))};var j=O;const w=e=>Object(o.createElement)(m.b,e),f=e=>{const{list:t,selected:r,renderItem:n,depth:a=0,onSelect:s,instanceId:i,isSingle:l,search:u}=e;return t?Object(o.createElement)(o.Fragment,null,t.map(t=>{const d=-1!==r.findIndex(e=>{let{id:r}=e;return r===t.id});return Object(o.createElement)(o.Fragment,{key:t.id},Object(o.createElement)("li",null,n({item:t,isSelected:d,onSelect:s,isSingle:l,search:u,depth:a,controlId:i})),Object(o.createElement)(f,c()({},e,{list:t.children,depth:a+1})))})):null},_=e=>{let{isLoading:t,isSingle:r,selected:n,messages:c,onChange:i,onRemove:l}=e;if(t||r||!n)return null;const u=n.length;return Object(o.createElement)("div",{className:"woocommerce-search-list__selected"},Object(o.createElement)("div",{className:"woocommerce-search-list__selected-header"},Object(o.createElement)("strong",null,c.selected(u)),u>0?Object(o.createElement)(s.Button,{isLink:!0,isDestructive:!0,onClick:()=>i([]),"aria-label":c.clear},Object(a.__)("Clear all","woo-gutenberg-products-block")):null),u>0?Object(o.createElement)("ul",null,n.map((e,t)=>Object(o.createElement)("li",{key:t},Object(o.createElement)(j,{label:e.name,id:e.id,remove:l})))):null)},v=e=>{let{filteredList:t,search:r,onSelect:n,instanceId:c,...s}=e;const{messages:u,renderItem:d,selected:p,isSingle:b}=s,m=d||w;return 0===t.length?Object(o.createElement)("div",{className:"woocommerce-search-list__list is-not-found"},Object(o.createElement)("span",{className:"woocommerce-search-list__not-found-icon"},Object(o.createElement)(i.a,{icon:l.a})),Object(o.createElement)("span",{className:"woocommerce-search-list__not-found-text"},r?Object(a.sprintf)(u.noResults,r):u.noItems)):Object(o.createElement)("ul",{className:"woocommerce-search-list__list"},Object(o.createElement)(f,{list:t,selected:p,renderItem:m,onSelect:n,instanceId:c,isSingle:b,search:r}))},k=e=>{const{className:t="",isCompact:r,isHierarchical:n,isLoading:a,isSingle:i,list:l,messages:u=b.a,onChange:m,onSearch:g,selected:h,debouncedSpeak:O}=e,[j,w]=Object(o.useState)(""),f=Object(p.useInstanceId)(k),E=Object(o.useMemo)(()=>({...b.a,...u}),[u]),S=Object(o.useMemo)(()=>Object(b.c)(l,j,n),[l,j,n]);Object(o.useEffect)(()=>{O&&O(E.updated)},[O,E]),Object(o.useEffect)(()=>{"function"==typeof g&&g(j)},[j,g]);const y=Object(o.useCallback)(e=>()=>{i&&m([]);const t=h.findIndex(t=>{let{id:r}=t;return r===e});m([...h.slice(0,t),...h.slice(t+1)])},[i,h,m]),P=Object(o.useCallback)(e=>()=>{-1===h.findIndex(t=>{let{id:r}=t;return r===e.id})?m(i?[e]:[...h,e]):y(e.id)()},[i,y,m,h]);return Object(o.createElement)("div",{className:d()("woocommerce-search-list",t,{"is-compact":r})},Object(o.createElement)(_,c()({},e,{onRemove:y,messages:E})),Object(o.createElement)("div",{className:"woocommerce-search-list__search"},Object(o.createElement)(s.TextControl,{label:E.search,type:"search",value:j,onChange:e=>w(e)})),a?Object(o.createElement)("div",{className:"woocommerce-search-list__list is-loading"},Object(o.createElement)(s.Spinner,null)):Object(o.createElement)(v,c()({},e,{search:j,filteredList:S,messages:E,onSelect:P,instanceId:f})))};Object(s.withSpokenMessages)(k)},96:function(e,t,r){"use strict";var n=r(5),c=r.n(n),o=r(0),a=r(34),s=r(3),i=r(4),l=r.n(i);t.a=e=>{let{className:t,item:r,isSelected:n,isLoading:i,onSelect:u,disabled:d,...p}=e;return Object(o.createElement)(o.Fragment,null,Object(o.createElement)(a.a,c()({},p,{key:r.id,className:t,isSelected:n,item:r,onSelect:u,isSingle:!0,disabled:d})),n&&i&&Object(o.createElement)("div",{key:"loading",className:l()("woocommerce-search-list__item","woocommerce-product-attributes__item","depth-1","is-loading","is-not-active")},Object(o.createElement)(s.Spinner,null)))}}});