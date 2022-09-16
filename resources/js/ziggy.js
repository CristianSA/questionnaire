const Ziggy = {"url":"http:\/\/test.questionnaire.com","port":null,"defaults":{},"routes":{"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"index guest":{"uri":"\/","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"student logout":{"uri":"logout","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"]},"password.email":{"uri":"password\/email","methods":["POST"]},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"]},"password.update":{"uri":"password\/reset","methods":["POST"]},"admin login":{"uri":"administrator\/login","methods":["GET","HEAD"]},"admin validate":{"uri":"administrator\/login\/validate","methods":["POST"]},"admin dashboard":{"uri":"administrator\/dashboard","methods":["GET","HEAD"]},"admin logout":{"uri":"administrator\/logout","methods":["POST"]},"admin projects":{"uri":"administrator\/projects","methods":["GET","HEAD"]},"admin show project":{"uri":"administrator\/show\/{project}","methods":["GET","HEAD"],"bindings":{"project":"id"}},"student validate":{"uri":"login\/validate","methods":["POST"]},"student register":{"uri":"register\/{project}","methods":["GET","HEAD"],"bindings":{"project":"id"}},"student register-validate":{"uri":"register\/validate\/{project}","methods":["POST"],"bindings":{"project":"id"}},"student dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"student projects":{"uri":"my-projects","methods":["GET","HEAD"]},"student results":{"uri":"my-results","methods":["GET","HEAD"]},"student modules":{"uri":"modules\/{project}","methods":["GET","HEAD"],"bindings":{"project":"id"}},"student module":{"uri":"module\/{module}","methods":["GET","HEAD"],"bindings":{"module":"id"}},"student questions":{"uri":"module\/questions\/{module}","methods":["GET","HEAD"],"bindings":{"module":"id"}},"student result":{"uri":"module\/questions\/results\/{module}","methods":["GET","HEAD"],"bindings":{"module":"id"}}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };