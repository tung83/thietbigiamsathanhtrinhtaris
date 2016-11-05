/*
 *  H.I.M JavaScript Vietnamese Input Method Source File 1.1 build 20060515
 *
 *	GNU Copyright (C) 2004  Hieu Dang Tran <lt2hieu2004 (at) sf (dot) net>
 *	Website:	http://hieu.acunett.com
 *				http://rhos.sf.net
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License, version 2,
 *  dated June 1991.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
*/

var notV="" //Put the ID of the field you DON'T want to let users type Vietnamese in, multiple fields allowed, separated by a comma (,)
var fID="htmlbox" //Put the ID of the iframe you want to let users type Vietnamese in
var method=0 //Default input method, 0 is AUTO, 1 is TELEX, 2 is VNI, 3 is VIQR, change accordingly
var on_off=1 //Start H.I.M on or off (1 is on, 0 is off)
var agt=navigator.userAgent.toLowerCase(),alphabet="QWERTYUIOPASDFGHJKLZXCVBNM\ "
var is_ie=((agt.indexOf("msie")!=-1) && (agt.indexOf("opera")==-1)),S,F,J,R,X,D,oc,sk,saveStr,iwindow,frame,is_opera=false
var ver="",support=true,changed=false,uni,uni2,g,h,SFJRX,DAWEO,Z,AEO,moc,trang,kl=0
var skey=new Array(97,226,259,101,234,105,111,244,417,117,432,121,65,194,258,69,202,73,79,212,416,85,431,89)
var english=fcc(272)+fcc(194)+fcc(258)+fcc(416)+fcc(431)+fcc(202)+fcc(212)

function notWord(word) {
	var str="\ \r\n#,\\;.:-_()<>+-*/=?!\"$%{}[]\'~|^\@\&\t"+fcc(160)
	return (str.indexOf(word)>=0)
}
function start(obj,key) {
	var w=""; oc=obj
	if(!method) { uni=telex; uni2=vni_viqr }
	else if(method==1) { uni=telex; uni2=false }
	else if((method==2) || (method==3)) { uni=vni_viqr; uni2=false }
	if(!is_ie) {
		var v=obj.value,pos
		if(v.length<=0) return
		if (!obj.data) {
			if (!obj.setSelectionRange) return
			pos=obj.selectionStart
		} else pos=obj.pos
		key=fcc(key.which); g=1
		while(1) {
			if(pos-g<0) break
			else if(notWord(v.substr(pos-g,1))) { if(v.substr(pos-g,1)=="\\") w=v.substr(pos-g,1)+w; break }
			else w=v.substr(pos-g,1)+w; g++
		}
		uni(w,key,pos)
		if((uni2)&&(!changed)) uni2(w,key,pos)
	} else {
		obj=ie_getText(obj)
		if(obj) {
			var sT=obj.curword.text
			w=uni(obj.curword.text,key,0)
			if((uni2) && ((w==sT) || (typeof(w)=='undefined'))) w=uni2(obj.curword.text,key,0)
			if(w) obj.curword.text=w
		}
	}
}
function ie_getText(obj) {
	var caret=obj.document.selection.createRange(),w=""
	if(caret.text) caret.text=""
	while(1) {
		caret.moveStart("character",-1)
		if(w.length==caret.text.length) break
		w=caret.text
		if(notWord(w.charAt(0))) {
			if(w.charCodeAt(0)==13) w=w.substr(2)
			else w=w.substr(1)
			break
		}
	}
	if(w.length) {
		caret.collapse(false)
		caret.moveStart("character",-w.length)
		obj.curword=caret.duplicate()
		return obj
	} else return false
}
function ie_replaceChar(w,pos,c) {
	var r=""
	if (((c==417) || (c==416)) && (w.substr(w.length-pos-1,1).toUpperCase()=='U') && (pos!=1)) {
		if (w.substr(w.length-pos-1,1)=='u') r=fcc(432)
		else r=fcc(431)
	}
	if (!isNaN(c)) {
		changed=true; r+=fcc(c)
		return w.substr(0,w.length-pos-r.length+1)+r+w.substr(w.length-pos+1)
	} else return w.substr(0,w.length-pos)+c+w.substr(w.length-pos+1)
}
function tr(k,w,by,sf,i) {
	var r,pos=findC(w,k,sf)
	if(pos) {
		if(pos[1]) {
			if(is_ie) return ie_replaceChar(w,pos[0],pos[1])
			else return replaceChar(oc,i-pos[0],pos[1])
		} else {
			var c,pC; r=sf; pC=w.substr(w.length-pos,1)
			for(g=0; g<r.length; g++) {
				if(isNaN(r[g])) var cmp=pC
				else var cmp=pC.charCodeAt(0)
				if(cmp==r[g]) {
					if(!isNaN(by[g])) c=by[g]
					else c=by[g].charCodeAt(0)
					if(is_ie) return ie_replaceChar(w,pos,c)
					else return replaceChar(oc,i-pos,c)
				}
			}
		}
	}
	return false
}
function vni_viqr(w,k,i) {
	if((method==2) || (method==0)) {
		DAWEO="6789"; SFJRX="12534"; S="1"; F="2"; J="5"; R="3"; X="4"; Z="0"; D="9"; FRX="234"; AEO="6"; moc="7"; trang="8"
	} else if(method==3) {
		DAWEO="^+(D"; SFJRX="'`.?~"; S="'"; F="`"; J="."; R="?"; X="~"; Z="-"; D="D"; FRX="`?~"; AEO="^"; moc="+"; trang="("
	}
	var uk=k.toUpperCase(),sf,by
	if(SFJRX.indexOf(uk)>=0) {
		var ret=sr(w,k,i)
		if(ret) return ret
	} else if(uk==D) { sf=new Array('d','D'); by=new Array(273,272) }
	else if(uk==AEO) {
		sf=new Array('a','A',259,258,'e','E','o','O',417,416,225,193,224,192,7841,7840,7843,7842,227,195,
								233,201,232,200,7865,7864,7867,7866,7869,7868,
								243,211,242,210,7885,7884,7887,7886,245,213,
					7854,7898,7856,7900,7862,7906,7858,7902,7860,7904)
		by=new Array(226,194,226,194,234,202,244,212,244,212,7845,7844,7847,7846,7853,7852,7849,7848,7851,7850,
						7871,7870,7873,7872,7879,7878,7875,7874,7877,7876,
						7889,7888,7891,7890,7897,7896,7893,7892,7895,7894,
					7844,7888,7846,7890,7852,7896,7848,7892,7850,7894)
	} else if(uk==moc) {
		sf=new Array('o','O',244,212,'u','U',243,211,242,210,7885,7884,7887,7886,245,213,
								250,218,249,217,7909,7908,7911,7910,361,360,
			7888,7890,7896,7892,7894)
		by=new Array(417,416,417,416,432,431,7899,7898,7901,7900,7907,7906,7903,7902,7905,7904,
						7913,7912,7915,7914,7921,7920,7917,7916,7919,7918,
			7898,7900,7906,7902,7904)
	} else if(uk==trang) {
		sf=new Array('a','A',226,194,225,193,224,192,7841,7840,7843,7842,227,195,
			7844,7846,7852,7848,7850)
		by=new Array(259,258,259,258,7855,7854,7857,7856,7863,7862,7859,7858,7861,7860,
			7854,7856,7862,7858,7860)
	} else if (uk==Z) { sf=ZF('sf'); by=ZF('by') }
	else return normC(w,k,i)
	return finish_uni(k,w,by,sf,i,uk)
}
function telex(w,k,i) {
	SFJRX="SFJRX"; DAWEO="DAWEO"; D='D'; S='S'; F='F'; J='J'; R='R'; X='X'; Z='Z'; FRX="FRX"
	var uk=k.toUpperCase(),sf,by
	if(SFJRX.indexOf(uk)>=0) {
		var ret=sr(w,k,i)
		if(ret) return ret
	} else if(uk==D) { sf=new Array('d','D'); by=new Array(273,272) }
	else if(uk=='A') {
		sf=new Array('a','A',259,258,225,193,224,192,7841,7840,7843,7842,227,195,
			7854,7856,7862,7858,7860,7870,7872,7878,7874,7876)
		by=new Array(226,194,226,194,7845,7844,7847,7846,7853,7852,7849,7848,7851,7850,
			7844,7846,7852,7848,7850,201,200,7864,7866,7868)
	} else if(uk=='W') {
		sf=new Array('a','A',226,194,'o','O',244,212,'u','U',225,193,224,192,7841,7840,7843,7842,227,195,
					243,211,242,210,7885,7884,7887,7886,245,213,
					250,218,249,217,7909,7908,7911,7910,361,360,
			7844,7846,7852,7848,7850,7888,7890,7896,7892,7894)
		by=new Array(259,258,259,258,417,416,417,416,432,431,7855,7854,7857,7856,7863,7862,7859,7858,7861,7860,
				7899,7898,7901,7900,7907,7906,7903,7902,7905,7904,
				7913,7912,7915,7914,7921,7920,7917,7916,7919,7918,
			7854,7856,7862,7858,7860,7898,7900,7906,7902,7904)
	} else if(uk=='E') {
		sf=new Array('e','E',233,201,232,200,7865,7864,7867,7866,7869,7868)
		by=new Array(234,202,7871,7870,7873,7872,7879,7878,7875,7874,7877,7876)
	} else if(uk=='O') {
		sf=new Array('o','O',417,416,243,211,242,210,7885,7884,7887,7886,245,213,
			7898,7900,7906,7902,7904)
		by=new Array(244,212,244,212,7889,7888,7891,7890,7897,7896,7893,7892,7895,7894,
			7888,7890,7896,7892,7894)
	} else if(uk==Z) { sf=ZF('sf'); by=ZF('by') }
	else return normC(w,k,i)
	return finish_uni(k,w,by,sf,i,uk)
}
function finish_uni(k,w,by,sf,i,uk) { if((DAWEO.indexOf(uk)>=0) || (Z.indexOf(uk)>=0)) return tr(k,w,by,sf,i) }
function ZF(k) {
	if(k=='sf') {
		var sf=repSign(null)
		for(h=0; h<english.length; h++) {
			sf[sf.length]=english.toLowerCase().charCodeAt(h)
			sf[sf.length]=english.charCodeAt(h)
		}
		return sf
	} else if(k=='by') {
		var by=new Array(),t="d,D,a,A,a,A,o,O,u,U,e,E,o,O".split(',')
		for (h=0; h<5; h++) { for (g=0; g<skey.length; g++) by[by.length]=skey[g] }
		for (h=0; h<t.length; h++) by[by.length]=t[h]
		return by
	}
}
function normC(w,k,i) {
	var uk=k.toUpperCase(),u=repSign(null),fixSign,sf=new Array(),c,j
	for(j=1; j<=w.length; j++) {
		for(h=0; h<u.length; h++) {
			if(u[h]==w.charCodeAt(w.length-j)) {
				if(h<=23) fixSign=S
				else if(h<=47) fixSign=F
				else if(h<=71) fixSign=J
				else if(h<=95) fixSign=R
				else fixSign=X
				c=skey[h%24]; if(alphabet.indexOf(uk)<0) return w
				w=w.substr(0,w.length-j)+fcc(c)+w.substr(w.length-j+1)+k
				if(!is_ie) {
					if(!oc.data) {
						var sp=oc.selectionStart,sst=oc.scrollTop
						oc.value=oc.value.substr(0,oc.selectionStart)+k+oc.value.substr(oc.selectionEnd)
						oc.setSelectionRange(sp+1,sp+1); oc.scrollTop=sst
					} else if(k.charCodeAt(0)!=32) { saveStr=k+saveStr; kl=1 }
					for(g=0; g<skey.length; g++) sf[sf.length]=fcc(skey[g])
					var pos=findC(w,fixSign,sf); changed=true; if((k.charCodeAt(0)==32) && (oc.data)) changed=false
					if(!pos) return
					var cc=retUni(w,fixSign,pos)
					replaceChar(oc,i-j,c)
					replaceChar(oc,i-pos+1,cc)
					if((k.charCodeAt(0)==32) && (oc.data)) changed=false
					return
				} else {
					var ret=sr(w,fixSign,0)
					if(ret) return ret
				}
			}
		}
	}
}
function spellerr(word,k) {
	var upword=word.toUpperCase(),tmpword=upword,update=false,gi="IO"
	var notViet="DD,AA,EE,OU,YY,YI,IY,EY,EA,EI,II,IO,UU,YO,YA".split(',')
	var vSConsonant="B,C,D,G,H,K,L,M,N,P,Q,R,T,V".split(','),vDConsonant="CH,GI,KH,NGH,GH,NG,NH,PH,QU,TH,TR".split(',')
	var vDConsonantE="CH,NG,NH".split(','),sConsonant="C,P,T,CH".split(','),vSConsonantE="C,M,N,P,T".split(',')
	if(FRX.indexOf(k.toUpperCase())>=0) {
		for(g=0; g<sConsonant.length; g++) {
			if(upword.substr(upword.length-sConsonant[g].length,sConsonant[g].length)==sConsonant[g]) return true
		}
	}
	for(g=0; g<word.length; g++) {
		if("FJZW1234567890".indexOf(upword.substr(g,1))>=0) return true
		for(h=0; h<notViet.length; h++) {
			if(upword.substr(g,notViet[h].length)==notViet[h]) {
				if((gi.indexOf(notViet[h])<0) || (g<=0) || (upword.substr(g-1,1)!='G')) return true
			}
		}
	}
	for(g=1; g<word.length; g++) { if("SX".indexOf(upword.substr(g,1))>=0) return true }
	for(h=0; h<vDConsonant.length; h++) {
		if(tmpword.substr(0,vDConsonant[h].length)==vDConsonant[h]) {
			tmpword=tmpword.substr(vDConsonant[h].length)
			update=true; break
		}
	}
	if(!update) {
		for(h=0; h<vSConsonant.length; h++) {
			if(tmpword.substr(0,1)==vSConsonant[h]) { tmpword=tmpword.substr(1); break }
		}
	}
	update=false
	for(h=0; h<vDConsonantE.length; h++) {
		if(tmpword.substr(tmpword.length-vDConsonantE[h].length)==vDConsonantE[h]) {
			tmpword=tmpword.substr(0,tmpword.length-vDConsonantE[h].length)
			update=true; break
		}
	}
	if(!update) {
		for(h=0; h<vSConsonantE.length; h++) {
			if(tmpword.substr(tmpword.length-1)==vSConsonantE[h]) { tmpword=tmpword.substr(0,tmpword.length-1); break }
		}
	}
	if(tmpword) {
		for(g=0; g<vDConsonant.length; g++) {
			for(h=0; h<tmpword.length; h++) { if(tmpword.substr(h,vDConsonant[g].length)==vDConsonant[g]) return true }
		}
		for(g=0; g<vSConsonant.length; g++) { if(tmpword.indexOf(vSConsonant[g])>=0) return true }
	}
	return false
}
function DAWEOF(cc,k) {
	var is_telex=(S=='S')?true:false,ret=new Array();ret[0]=g
	if (is_telex) {
		if(k=='A') {
			if(cc==226) ret[1]='a'
			else if(cc==194) ret[1]='A'
		} else if(k=='W') {
			if(cc==259) ret[1]='a'
			else if(cc==258) ret[1]='A'
			else if(cc==417) ret[1]='o'
			else if(cc==416) ret[1]='O'
			else if(cc==432) ret[1]='u'
			else if(cc==431) ret[1]='U'
		} else if(k=='E') {
			if(cc==234) ret[1]='e'
			else if(cc==202) ret[1]='E'
		} else if(k=='O') {
			if(cc==244) ret[1]='o'
			else if(cc==212) ret[1]='O'
		}
	} else {
		if (k==AEO) {
			if (cc==226) ret[1]='a'
			else if (cc==194) ret[1]='A'
			else if (cc==244) ret[1]='o'
			else if (cc==212) ret[1]='O'
			else if (cc==234) ret[1]='e'
			else if (cc==202) ret[1]='E'
		} else if (k==moc) {
			if (cc==417) ret[1]='o'
			else if (cc==416) ret[1]='O'
			else if (cc==432) ret[1]='u'
			else if (cc==431) ret[1]='U'
		} else if (k==trang) {
			if (cc==259) ret[1]='a'
			else if (cc==258) ret[1]='A'
		}
	}
	if (ret[1]) return ret
	else return false
}
function findC(word,k,sf) {
	if((method==3)&&(word.substr(word.length-1,1)=="\\")) return new Array(1,k.charCodeAt(0))
	var str="",res,cc="",pc="",tE="",vowArr=new Array(),s=fcc(194)+fcc(258)+fcc(202)+fcc(212)+fcc(416)+fcc(431),c=0
	for(g=0; g<sf.length; g++) {
		if(isNaN(sf[g])) str+=sf[g]
		else str+=fcc(sf[g])
	}
	var uk=k.toUpperCase(),i=word.length,uni_array=repSign(k)
	if (DAWEO.indexOf(uk)>=0) {
		var found=false
		for(g=1; g<=word.length; g++) {
			cc=word.substr(word.length-g,1)
			pc=word.substr(word.length-g-1,1).toUpperCase()
			uc=cc.toUpperCase()
			if(str.indexOf(uc)>=0) {
				if((uk=='W')&&(uc=='A')&&(pc=='U')) {
					if((word.length-g)>=2) {
						ccc=word.substr(word.length-g-2,1).toUpperCase()
						if(ccc!="Q") res=g+1
						else res=g
					} else res=g+1
				} else res=g
				break
			} else if(english.indexOf(uc)>=0) {
				charCode=cc.charCodeAt(0)
				if(uk==D) {
					if(charCode==273) res=new Array(g,'d')
					else if(charCode==272) res=new Array(g,'D')
				} else res=DAWEOF(charCode,uk)
				if(res) break
			}
		}
	}
	if((uk!=Z)&&(DAWEO.indexOf(uk)<0)) { var tEC=retKC(uk); for (g=0; g<tEC.length; g++) tE+=fcc(tEC[g]) }
	for(g=1; g<=word.length; g++) {
		if(DAWEO.indexOf(uk)<0) {
			cc=word.substr(word.length-g,1).toUpperCase()
			pc=word.substr(word.length-g-1,1).toUpperCase()
			if(str.indexOf(cc)>=0) {
				if(cc=='U') {
					if(pc!='Q') { c++; vowArr[vowArr.length]=g }
				} else if(cc=='I') {
					if((pc!='G') || (c<=0)) { c++; vowArr[vowArr.length]=g }
				} else { c++; vowArr[vowArr.length]=g }
			} else if(uk!=Z) {
				for(h=0; h<uni_array.length; h++) if(uni_array[h]==word.charCodeAt(word.length-g)) return new Array(g,tEC[h%24])
				for(h=0; h<tEC.length; h++) if(tEC[h]==word.charCodeAt(word.length-g)) return new Array(g,fcc(skey[h]))
			}
		} else if((uk!=Z)&&(!res)&&(!found)) {
			for(h=0; h<uni_array.length; h++) {
				if(uni_array[h]==word.charCodeAt(word.length-g)) {
					var nk, kc=skey[h%24]; sf=getSF()
					if(h<=23) nk=S
					else if(h<=47) nk=F
					else if(h<=71) nk=J
					else if(h<=95) nk=R
					else nk=X
					word=word.substr(0,word.length-g)+fcc(kc)+word.substr(word.length-g+1)+k
					return findC(word,nk,sf)
				}
			}
		}
	}
	if(DAWEO.indexOf(uk)<0) {
		for(g=1; g<=word.length; g++) {
			if((uk!=Z)&&(s.indexOf(word.substr(word.length-g,1).toUpperCase())>=0)) return g
			else if(tE.indexOf(word.substr(word.length-g,1))>=0) {
				for(h=0;h<tEC.length;h++) {
					if(word.substr(word.length-g,1).charCodeAt(0)==tEC[h]) return new Array(g,fcc(skey[h]))
				}
			}
		}
	}
	if(spellerr(word,k)) return false
	if(res) return res
	if((c==1) || (uk==Z)) return vowArr[0]
	else if(c==2) {
		var c2=0,fdconsonant,sc="BCD"+fcc(272)+"GHKLMNPQRSTVX",dc="CH,GI,KH,NGH,GH,NG,NH,PH,QU,TH,TR".split(',')
		for(h=1; h<=word.length; h++) {
			fdconsonant=false
			for(g=0; g<dc.length; g++) {
				if(dc[g].indexOf(word.substr(word.length-h-dc[g].length+1,dc[g].length).toUpperCase())>=0) {
					c2++; fdconsonant=true
					if(dc[g]!='NGH') h++
					else h+=2
				}
			}
			if(!fdconsonant) {
				if(sc.indexOf(word.substr(word.length-h,1).toUpperCase())>=0) c2++
				else break
			}
		}
		if((c2==1) || (c2==2)) return vowArr[0]
		else return vowArr[1]
	} else if(c==3) return vowArr[1]
	else if(c>3) return vowArr[0]
	else return false
}
function repSign(k) {
	var t=new Array(), u=new Array()
	for (g=0; g<5; g++) {
		if ((k==null) || (SFJRX.substr(g,1)!=k.toUpperCase())) {
			t=retKC(SFJRX.substr(g,1))
			for (h=0; h<t.length; h++) u[u.length]=t[h]
		}
	}
	return u
}
function sr(w,k,i) {
	var sf=getSF()
	pos=findC(w,k,sf)
	if(pos) {
		if(pos[1]) {
			if(!is_ie) replaceChar(oc,i-pos[0],pos[1])
			else return ie_replaceChar(w,pos[0],pos[1])
		} else {
			var c=retUni(w,k,pos)
			if (!is_ie) replaceChar(oc,i-pos,c)
			else return ie_replaceChar(w,pos,c)
		}
	}
	return false
}
function retUni(w,k,pos) {
	var u=retKC(k.toUpperCase()),uC,lC,c=w.charCodeAt(w.length-pos)
	for (g=0; g<skey.length; g++) if (skey[g]==c) {
		if (g<12) { lC=g; uC=g+12 }
		else { lC=g-12; uC=g }
		if (fcc(c)!=fcc(c).toUpperCase()) return u[lC]
		return u[uC]
	}
}
function replaceChar(o,pos,c) {
	if(!isNaN(c)) { var replaceBy=fcc(c); changed=true }
	else var replaceBy=c
	if(!o.data) {
		var savePos=o.selectionStart,sst=o.scrollTop
		if (((c==417) || (c==416)) && (o.value.substr(pos-1,1).toUpperCase()=='U') && (pos<savePos-1)) {
			if (o.value.substr(pos-1,1)=='u') var r=fcc(432)
			else var r=fcc(431)
		}
		o.setSelectionRange(pos,pos+1)
		o.value=o.value.substr(0,o.selectionStart)+replaceBy+o.value.substr(o.selectionEnd)
		if(r) {
			o.setSelectionRange(pos-1,pos)
			o.value=o.value.substr(0,o.selectionStart)+r+o.value.substr(o.selectionEnd)
		}
		o.setSelectionRange(savePos,savePos); o.scrollTop=sst
	} else {
		if (((c==417) || (c==416)) && (o.data.substr(pos-1,1).toUpperCase()=='U') && (pos<o.pos-1)) {
			if (o.data.substr(pos-1,1)=='u') var r=fcc(432)
			else var r=fcc(431)
		}
		o.deleteData(pos,1); o.insertData(pos,replaceBy)
		if(r) { o.deleteData(pos-1,1); o.insertData(pos-1,r) }
	}
}
function retKC(k) {
	if(k==S) return new Array(225,7845,7855,233,7871,237,243,7889,7899,250,7913,253,193,7844,7854,201,7870,205,211,7888,7898,218,7912,221)
	else if(k==F) return new Array(224,7847,7857,232,7873,236,242,7891,7901,249,7915,7923,192,7846,7856,200,7872,204,210,7890,7900,217,7914,7922)
	else if(k==J) return new Array(7841,7853,7863,7865,7879,7883,7885,7897,7907,7909,7921,7925,7840,7852,7862,7864,7878,7882,7884,7896,7906,7908,7920,7924)
	else if(k==R) return new Array(7843,7849,7859,7867,7875,7881,7887,7893,7903,7911,7917,7927,7842,7848,7858,7866,7874,7880,7886,7892,7902,7910,7916,7926)
	else if(k==X) return new Array(227,7851,7861,7869,7877,297,245,7895,7905,361,7919,7929,195,7850,7860,7868,7876,296,213,7894,7904,360,7918,7928)
}
function getSF() { var sf=new Array(); for(var x=0; x<skey.length; x++) sf[sf.length]=fcc(skey[x]); return sf }
function onKeyDown(e) {
	if (e=='iframe') var key=frame.event.keyCode
	else var key=(!is_ie)?e.which:window.event.keyCode
	if((key==120) || (key==123)) {
		if(key==120) {
			on_off=1
			if(method==3) method=0
			else method++
		} else if(on_off==0) on_off=1
		else if(on_off==1) on_off=0
		setCookie()
	}
	if((is_ie) || (ver>=1.3)) statusMessage()
}
function statusMessage() {
	var str='Mode: '
	if(on_off==0) str+='NONE'
	else if(method==1) str+='TELEX'
	else if(method==2) str+='VNI'
	else if(method==3) str+='VIQR'
	else if(method==0) str+='AUTO'
	str+=" [F9=AUTO->TELEX->VNI->VIQR; F12=On/Off]"
	window.status=str
}
function ifInit() {
	var sel=iwindow.getSelection(),range=null
	iwindow.focus()
	range=sel?sel.getRangeAt(0):document.createRange()
	return range
}
function ifMoz(e) {
	if(e.ctrlKey) return
	var code=e.which,range=ifInit(),node=range.endContainer; sk=fcc(code); saveStr=""
	if(checkCode(code) || !range.startOffset || (typeof(node.data)=='undefined')) return
	if(node.data) {
		saveStr=node.data.substr(range.endOffset)
		node.deleteData(range.startOffset,node.data.length)
	}
	range.setEnd(node,range.endOffset)
	range.setStart(node,0)
	if(!node.data) return
	node.value=node.data; node.pos=node.data.length; node.which=code
	start(node,e)
	node.insertData(node.data.length,saveStr)
	range.setEnd(node,node.data.length-saveStr.length+kl)
	range.setStart(node,node.data.length-saveStr.length+kl); kl=0
	if(changed) { changed=false; e.preventDefault() }
}
function FKeyPress(obj) {
	sk=fcc(obj.event.keyCode)
	if(checkCode(obj.event.keyCode) || (obj.event.ctrlKey)) return
	start(obj,fcc(obj.event.keyCode))
}
function checkCode(code) { if(((on_off==0) || (code<45) || (code==145) || (code==255)) && (code!=32) && (code!=39) && (code!=40) && (code!=43)) return true }
function fcc(x) { return String.fromCharCode(x) }
function setCookie() {
	var now=new Date(),exp=new Date(now.getTime()+1000*60*60*24*365)
	exp=exp.toGMTString()
	document.cookie='HIM_on_off='+on_off+';expires='+exp
	document.cookie='HIM_method='+method+';expires='+exp
}
function getCookie() {
	var ck=document.cookie, res=/HIM_method/.test(ck)
	if(!res) { setCookie(); return }
	var p,ckA=ck.split(';')
	for(var i=0;i<ckA.length;i++) {
		p=ckA[i].split('='); p[0]=p[0].replace(/^\s+/g,""); p[1]=parseInt(p[1])
		if(p[0]=='HIM_on_off') on_off=p[1]
		else if(p[0]=='HIM_method') method=p[1]
	}
}
if(!is_ie) {
	if(agt.indexOf("opera")==-1) {
		for(var k=0; k<agt.length; k++) if(agt.substr(k,3)=="rv:") break
		k+=3; for(k; k<agt.length; k++) {
			if((isNaN(agt.substr(k,1))) && (agt.substr(k,1)!='.')) break
			ver+=agt.substr(k,1)
		}
		for(k=0; k<ver.length; k++) if(ver.substr(k,1)=='.') ver=ver.substr(0,k+2)
	} else {
		operaV=agt.split(" ")
		if(parseInt(operaV[operaV.length-1])>=8) is_opera=true
	}
}
if((is_ie) || (ver>=1.3) || (is_opera)) { getCookie(); statusMessage() }
else support=false
document.onkeydown=function(e) { onKeyDown(e) }
document.onkeypress=function(e) {
	if(!support) return
	if(!is_ie) { var el=e.target; var code=e.which; if(e.ctrlKey) return }
	else { var el=window.event.srcElement; var code=window.event.keyCode; if(event.ctrlKey) return }
	if(((el.type!='textarea') && (el.type!='text') && (el.id!=fID)) || checkCode(code)) return
	va=notV.split(","); for(i=0;i<va.length;i++) if((el.id==va[i])&&(va[i].length>0)) return
	if(!is_ie) { sk=fcc(e); start(el,e) }
	else { sk=fcc(code); start(el,sk) }
	if(changed) { changed=false; return false }
}
if(typeof(fID)!='undefined') {
	if(is_ie) {
		frame=document.frames[fID]
		if((typeof(frame)!='undefined') && (document.frames[fID].document)) {
			var doc=document.frames[fID].document
			doc.designMode="On"
			doc.onkeydown=function() { onKeyDown('iframe') }
			doc.onkeypress=function() { FKeyPress(frame); if(changed) { changed=false; return false } }
		}
	} else {
		if(document.getElementById(fID)) {
			iwindow=document.getElementById(fID).contentWindow
			var iframedit=iwindow.document
			iframedit.designMode="On"
			iframedit.addEventListener("keypress",ifMoz,true)
			iframedit.addEventListener("keydown",onKeyDown,true)
		}
	}
}
