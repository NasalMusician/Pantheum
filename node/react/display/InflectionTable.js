var FormattedValue = require('./FormattedValue');
var FormattedWord = require('./FormattedWord');

function _do_ignore(l,ignore) {
	if (!ignore || !l) return l;
	var vec = Array.isArray(l);
	ignore = ignore.map(p=>p.toString()).filter(p=>!p.includes('/'));
	if (Array.isArray(l)) {
		var m = l.map((v,k) => {
			if (typeof v === 'object') {
				v = _do_ignore(v,ignore);
				if (('length' in v) ? v.length : Object.keys(v).length)
					return v;
			} else if (!ignore.contains(v)) {
				return v;
			}
		}).filter(v=>v!==undefined);
		console.log(l,m);
		for (let k of l.keys()) delete l[k];
		l.length = 0;
		for (let n of m) l.push(n);
		return l;
	}
	for (let k in l) {
		let v = l[k];
		if (typeof v === 'object') {
			v = l[k] = _do_ignore(v,ignore);
			if (!v || ignore.includes(k))
				delete l[k];
		} else if (ignore.contains(v))
			delete l[k];
	}
	return l;
}

function _in_ignore(p,ignore) {
	if (!ignore) return false;
	var base = model.Path(p);
	return ignore.some(ig => p.issub(base.reset().add2(ig), true));
}

function _filter_ignore(values, ignore, p, empty=true, prev=null) {
	var ret = [];
	if (values !== null && values !== false) {
		if (prev) {
			if (!prev[0]) prev[0]=[false];
			var count = [];
			ret['_'] = [];
			for (var k of prev[0]) {
				ret[k] = _filter_ignore(values, ignore, model.Path(p,k), empty, array_slice(prev, 1));
				// TODO: only works when prev.length === 1
				count.push(...ret[k]);
			}
			for (let v of values) {
				if (count.includes(v))
					ret['_'].push(v);
			}
		} else {
			for (var v of values) {
				if (!v || !_in_ignore(model.Path(p,v),ignore))
					ret.push(v);
			}
		}
	}
	if (empty || ret)
		return ret;
	return [false];
}
function _filter_ignore2(values, ignore, p, parallel, prev=null) {
	for (let key in values)
		values[key] = _filter_ignore(values[key], ignore, model.Path(p,key), true, prev?[prev[key]]:null);
}
function _fill(values, parallel) {
	var ret = [];
	for (var k of parallel) {
		ret[k] = values;
	}
	return ret;
}
function is_fillable(v) {
	if (!Array.isArray(v)) return false;
	return !v.some(Array.isArray);
	for (var k of v) {
		if (Array.isArray(k)) return false;
	}
	return true;
}

var model = require('../../model');

// Parse the depath into the necessary row/column values for the table
function word_table_values(w,ignore=null) {
	//if (!w.read_paths()) return [null,null,null,null,null];
	var lang = w.lang;
	var spart = w.spart;
	// values[0] : table name
	// values[1] : major vertical
	// values[2] : minor vertical
	// values[3] : major horizontal
	// values[4] : minor horizontal
	var values = lang.depaths[spart].table_values(w, ignore);
	values[0] = _do_ignore(values[0],ignore);
	if (!values[0]) values[0] = [false];
	if (Array.isArray(values[1])) values[1] = _fill(values[1], values[0]);
	if (Array.isArray(values[2])) values[2] = _fill(values[2], values[0]);
	if (Array.isArray(values[3])) values[3] = _fill(values[3], values[0]);
	if (Array.isArray(values[4])) values[4] = _fill(values[4], values[0]);
	_filter_ignore2(values[1],ignore,model.Path({word:w}),values[0]);
	_filter_ignore2(values[2],ignore,model.Path({word:w}),values[0],values[1]);
	_filter_ignore2(values[3],ignore,model.Path({word:w}),values[0]);
	_filter_ignore2(values[4],ignore,model.Path({word:w}),values[0],values[3]);
	return values;
}

var React = require('react');
var h = require('react-hyperscript');

module.exports = (function(view) {
	var reduconcat = (a,b)=>a.concat(b);
	function is_element(el, ...types) {
		return React.isValidElement(el) && (!types || types.includes(el.type));
	}

	view.Scrollable = view.createClass({
		displayName: 'view.Scrollable',
		render: function renderScrollable() {
			return h('div', Object.assign({
				style: Object.assign({}, this.props, {
					overflow: 'auto',
					WebkitOverflowScrolling: 'touch',
				}, this.props.style)
			}), this.props.children);
		},
	});

	view._notProps = true;
	view.table = {
		_notProps: true,
		th: {
			_notProps: true,
		},
		td: {
			_notProps: true,
		},
		tr: {
			_notProps: true,
			_wrap: function(fn) {
				return function() {
					return h('tr', {}, fn.apply(this, arguments));
				}
			},
		},
	};
	var {th,td,tr} = view.table;
	var noselect = {
		userSelect:'none',
		msUserSelect:'none',
		WebkitUserSelect:'none',
		MozUserSelect:'none',
	};
	var nbsp = '\u00A0';
	th.blank = function(props={}) {
		if (!props.style) props.style = noselect;
		return h('th', props, nbsp);
	};
	th.space = function(space='1.5em') {
		var props = {};
		if (this && !this['_notProps'])
			props = Object.assign(props, this);
		if (space) {
			if (!props.style) props.style = {};
			if (!props.style.padding && !props.style.paddingLeft)
				props.style.paddingLeft = space;
		}
		return h('th', props);
	};

	var format_value_props = view.expand.React({
		style: {
			textAlign: 'left',
		}
	}, {
		minor: {
			style: {
				fontWeight: view.expand.preserve('normal'),
				fontFamily: 'Linux Biolinum',
				fontSize: '95%',
				paddingRight: '0.4em',
				whiteSpace: 'nowrap',
			},
		},
		major: {
			style: {
				fontWeight: 'bold',
				fontFamily: 'Linux Biolinum',
				paddingRight: '0.4em',
				whiteSpace: 'nowrap',
			},
		},
		greatest: {
			style: {
				fontWeight: 'bold',
				//fontStyle: 'italic',
				fontFamily: 'Linux Biolinum',
				textTransform: 'uppercase',
				paddingRight: '1em',
				whiteSpace: 'nowrap',
			},
		},
	});
	th.format_value = function(value) {
		if (this && !this['_notProps']) var props = Object.assign({}, this);
		return h('th', props, FormattedValue.h({value}));
	};
	th.format_value.minor = function() {
		var props = format_value_props('minor', this && !this['_notProps'] ? this : {});
		return th.format_value.apply(props, arguments);
	};
	th.format_value.major = function() {
		var props = format_value_props('major', this && !this['_notProps'] ? this : {});
		return th.format_value.apply(props, arguments);
	};
	th.format_value.greatest = function(...arg) {
		var props = format_value_props('greatest', this && !this['_notProps'] ? this : {});
		return th.format_value.apply(props, arguments);
	};

	td.format_word = function(value) {
		if (this && !this['_notProps'])
			var props = Object.assign({}, this);
		return h('td', props, FormattedWord.h({value}));
	};

	// Make a row containing one cell:
	tr.blank = tr._wrap(th.blank);
	tr.format_value = tr._wrap(th.format_value);
	tr.format_value.major = tr._wrap(th.format_value.major);
	tr.format_value.minor = tr._wrap(th.format_value.minor);
	tr.format_word = tr._wrap(td.format_word);

	// Create horizontal major columns
	tr.H = function({w, ignore, values}) {
		return values[3].map(
			v => th.format_value.major.call({
				colSpan: (v in values ? values[v] : values)[4].length
			}, v)
		);
	};
	// Create horizontal minor columns
	tr.h = function({ignore, values}) {
		return values[3].map(
			v => (v in values ? values[v] : values)[4].map(
				c => th.format_value.minor(c)
			)
		).reduce(reduconcat);
	};

	// Group values based on optimization flag
	function getgroups({p:basepath, optimization, ignore, values}) {
		var getv = (v,j) => v in values ? values[v][j] : values[j];
		var groups = [], last  = NaN, lastp;
		for (let _3 of values[3]) {
			let _4s = getv(_3,4);
			for (let _4 of _4s) {
				let p = model.Path(basepath).add2(_3, _4);
				let span = 1;
				let g = {p, _3, _4, span};
				if (lastp && p.issub(lastp, true) && lastp.issub(p, true)) {
					groups[groups.length-1][groups[groups.length-1].length-1].span += span;
				} else if (last && !_in_ignore(p, ignore) && optimization & 2 && p.value === last) {
					groups[groups.length-1].push(g);
					lastp = p;
				} else {
					groups.push([g]);
					lastp = p;
					last = p.value;
				}
			}
		}
		return groups;
	};

	var cell_props = view.expand.React({
		style: {
			border: '1px dashed #AAA',
			borderLeft: null, borderRight: null,
			padding: '0.5ex 0.5em'
		},
	}, {
		left: {
			style: {
				borderLeft: '1px solid #888',
			},
		},
		right: {
			style: {
				borderRight: '1px solid #888',
			},
		},
		topdiv: {
			style: {
				borderTop: '1px solid #888',
			}
		}
	});

	// Inflect a simple table: minor vertical division and horizontal values
	tr.body = function({p:basepath, optimization, ignore, i, values, gutter, rows=[]}) {
		let prevv;
		for (let v of values[2]) {
			let path = model.Path(basepath).add(v);
			let row = [];
			if (gutter > 1) row.push(th.space('1.5em'));
			row.push(th.format_value.minor(v));
			let getv = j => v in values ? values[v][j] : values[j];
			let groups = getgroups({p:path, optimization, ignore, values:values.slice(0,3).concat([3,4].map(getv))});
			let last3 = NaN;
			for (let group of groups) {
				let ditto, _ = group.length-1, {p,span} = group[0];
				let {_3:_30, _4:_40} = group[0];
				let {_3:_3_, _4:_4_} = group[_];
				let {_3,_4} = group[0]; if (_) _3 = _4 = undefined;
				if (!_) ditto = (prevv && p.value && p.value === model.Path(p, prevv).value);
				let val;
				if (_in_ignore(p, ignore) && p.hasvalue())
					val = h('abbr', {className:'symbolic', title:"Not learned yet"}, '—');
				else val = FormattedWord.h({value:p});
				let link;
				//if (getlink) link = getlink(p);
				if (link) val = view.make_link(link, val);
				if (_) val = h('span', [view.arrow.float.left, view.arrow.float.right, val]);
				else if (ditto && optimization & 1) val = nbsp+'\u2044'+nbsp+'\u2044';
				var props = {key:p.toString(), colSpan:span};
				var pos = [];
				if (_3 !== last3) pos.push('left');
				if (group === groups[groups.length-1]) pos.push('right');
				props = cell_props.call(this, pos, props);
				//console.log(cell_props.live.simplify().style, props.style, props.style.borderBottom);
				row.push(h('td', props, val));
				//if (extras) row.push(...extras(p));
				last3 = _3;
			}
			rows.push(row);
			prevv = v;
		}
		return rows;
	};
	// Inflect major vertical sections
	tr.bodysection = function({p:basepath, optimization, ignore, i, values, gutter, rows=[]}) {
		var p = model.Path(basepath);
		if (values[1]) {
			for (let v of values[1]) {
				rows.push(tr.format_value.major.call({
					colSpan: 2,
				}, v));
				if (v) p.add(v);
				let getv = j => v in values ? values[v][j] : values[j];
				let vals = values.slice(0,2).concat([2,3,4].map(getv));
				rows = tr.body({p, optimization, ignore, values:vals, gutter, rows});
			}
			return rows;
		}
		return tr.body({p, optimization, ignore, values, gutter, rows});
	};
	// Inflection major table divisions
	tr.subtable = function({p, optimization, ignore, i, values, gutter, heading, rows=[]}) {
		if (!heading)
			heading = th.blank({colSpan:gutter});
		else if (!is_element(heading, 'th', 'td'))
			heading = th.format_value.greatest.call({colSpan:gutter}, heading);
		rows.push([heading, ...tr.H({p,ignore,values})]);
		heading = th.blank({colSpan:gutter});
		if (values[4] && values[4].some(Boolean))
			rows.push([heading, ...tr.h({p,ignore,values})]);
		return tr.bodysection({p, optimization, ignore, values, gutter, rows});
	};

	// Compose a full inflection table
	view.do_table = function(w, values, ignore, optimization=0) {
		// values.every((v,i)=>(!v||!v.length)!==(i===1));
		if (values[1] &&
		   !values[2] &&
		   !values[3] &&
		   !values[4] &&
		   !values[0]) {
			return values[1].map(_1 => [
				tr.format_value(_1),
				tr.format_word(w.path(_1), w.lang, true)
			]).reduce(reduconcat,[]);
		}
		var gutter = 1;
		if (values[0]) {
			var getv = (v,j) => v in values ? values[v][j] : values[j];
			var gutter = 1+values[0].some(v=>getv(v,1)&&getv(v,1).length);
			return values[0].map((v,i) => [
				...(i?[tr.blank({key:'blank'+i})]:[]),
				...tr.subtable({
					heading: v,
					p: model.Path({word:w}, v),
					values: [
						values[0],
						getv(v,1),
						getv(v,2),
						getv(v,3),
						getv(v,4),
					], gutter,
					ignore, i,
				})
			]).reduce(reduconcat,[]);
		}
		return tr.subtable({
			p: model.Path({word:w}), values, gutter,
			optimization, ignore,
		});
	};

	var autokey = (el, i) => el==null ? i : (typeof el === 'number' ? el : el.key || el.toString());

	// Create a React table from a list of rows, converting to appropriate React components
	view.create_table = function(data, options, props) {
		var {noheader} = options||{};
		var rows = data.map(
			(row, i) => React.isValidElement(row) ? row :
				h('tr', {key:i}, row.map(
					(el, k) => React.isValidElement(el) && (['td','th'].includes(el.type)) ? el :
						el !== undefined ? h(i || noheader ? 'td' : 'th', {key:autokey(el, k)}, el) : el
				))
		);
		return h('table', props||{}, [h('tbody', rows)]);
	};

	// Create a React table which merges values hierarchically
	view.create_table.merge_vertical = function(data, options, ...arg) {
		var {noheader} = options||{};
		var header = data.slice(0, +!noheader), rest = data.slice(+!noheader);
		var nrows = (i,start,v) => {
			if (!start) start = 0;
			if (!v) var v = rest[start][i];
			for (var j=start; j<rest.length; j++)
				if (rest[j][i] != v) break;
			return i ? Math.min(j-start, nrows(i-1,start)) : j-start;
		};
		var keep = (i,start) => {
			if (!start) return true;
			for (i; i>=0; i--)
				if (rest[start-1][i] != rest[start][i]) return true;
			return false;
		};
		data = header.concat(rest.map(
			(row, j) =>
				row.map((el, i) => {
					if (!keep(i, j)) return;
					return h('td', {key:autokey(el, i), rowSpan: nrows(i, j, el)}, el)
				})
		));
		return view.create_table(data, options, ...arg);
	};

	view.InflectionTable = view.createClass({
		displayName: 'view.InflectionTable',
		render: function() {
			var {word, values, ignore, optimization} = this.props;
			if (!values) values = word_table_values(word);
			return view.Scrollable.h({}, view.create_table(view.do_table(word, values, ignore, optimization), {noheader:true}, {style:{borderCollapse:'collapse'}}));
		},
	});

	return view;
}({createClass:require('../createClass'),expand:require('../expand')}));
