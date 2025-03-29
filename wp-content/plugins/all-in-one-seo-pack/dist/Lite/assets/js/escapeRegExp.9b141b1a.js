import{t as e}from"./toString.f0787db8.js";var r=/[\\^$.*+?()[\]{}|]/g,o=RegExp(r.source);function a(n){return n=e(n),n&&o.test(n)?n.replace(r,"\\$&"):n}export{a as e};
