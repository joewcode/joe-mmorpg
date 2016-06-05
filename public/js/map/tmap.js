// Тестовая карта




function createScene() {
	// ### Создаем сцену
	var scene = new BABYLON.Scene(engine);
//	scene.clearColor = new BABYLON.Color3(0, 0, 0);
	scene.gravity = new BABYLON.Vector3(0, -0.2, 0); // (0, -0.2, 0);
	scene.collisionsEnabled = true;
        
	// ### Положение камеры и передвижение
	
	var camera = new BABYLON.FreeCamera("camera1", new BABYLON.Vector3(0, 10, -20), scene); // X Y Z
//	camera.applyGravity = true;
	camera.checkCollisions = true;
	camera.setTarget(BABYLON.Vector3.Zero());
	camera.attachControl(canvas, false);
	camera.speed = 5;
	
	// Движение wasd
//	camera.keysUp=[38,87]; camera.keysDown=[40,83]; camera.keysLeft=[37,65]; camera.keysRight=[39,68];
	
	
	// ### Отрисовка солнца
            var light = new BABYLON.DirectionalLight("light", new BABYLON.Vector3(-1, -2, -1), scene);
            light.intensity = 1;
            light.position = new BABYLON.Vector3(40, 40, 40);
            var shadowLight = new BABYLON.ShadowGenerator(1024, light);
            shadowLight.useBlurVarianceShadowMap = true;
            shadowLight.blurBoxOffset = 2.0;
	// ### 
            var ground = BABYLON.Mesh.CreateGround("ground1", 500, 500, 1, scene, false);
            ground.checkCollisions = true;
            ground.receiveShadows = true;
			//
            ground.material = new BABYLON.StandardMaterial("matground", scene);
            ground.material.diffuseTexture = new BABYLON.Texture("/img/textures/map/tmap/ground.jpg", scene, false);
            ground.material.bumpTexture = new BABYLON.Texture("/img/textures/map/tmap/normalMap.jpg", scene, false);
            ground.material.diffuseTexture.uScale = ground.material.diffuseTexture.vScale = 10;
            ground.material.bumpTexture.uScale = ground.material.bumpTexture.vScale = 10;
	//
			// Контейнер локации
            var skybox = BABYLON.Mesh.CreateBox("skyBox", 500.0, scene);
            var skyboxMaterial = new BABYLON.StandardMaterial("skyBox", scene);
            skyboxMaterial.backFaceCulling = false;
            skyboxMaterial.reflectionTexture = new BABYLON.CubeTexture("/img/textures/map/tmap/TropicalSunnyDay", scene);
            skyboxMaterial.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
            skyboxMaterial.diffuseColor = new BABYLON.Color3(0, 0, 0);
            skyboxMaterial.specularColor = new BABYLON.Color3(0, 0, 0);
            skybox.material = skyboxMaterial;
        
		
		// #####
		var shadowMap = shadowLight.getShadowMap();
			var sphere = BABYLON.Mesh.CreateSphere("sphere1", 0, 0, scene);
			sphere.position.y = 3;
			sphere.checkCollisions = true;
			sphere.material = new BABYLON.StandardMaterial("matsphere", scene);
			sphere.material.diffuseTexture = new BABYLON.Texture("/img/textures/map/tmap/flare.png", scene, false);
			sphere.parent = camera;
			shadowMap.renderList.push(sphere);
		
		
	// ##############################################
//	var sphere = BABYLON.Mesh.CreateSphere("sphere1", 16, 2, scene);
//	sphere.position.y = 1;
//	camera.setTarget(sphere.Vector3.Zero());
	
	
						/*
			 var shadowMap = shadowLight.getShadowMap();
				var sphere = BABYLON.Mesh.CreateSphere("sphere1", 16, 4, scene);
				sphere.position.y = 2;
				sphere.checkCollisions = true;
				sphere.material = new BABYLON.StandardMaterial("matsphere", scene);
				sphere.material.diffuseTexture = new BABYLON.Texture("textures/flare.png", scene, false);
			//    sphere.parent = camera;
				shadowMap.renderList.push(sphere);
			
				var box1 = BABYLON.Mesh.CreateBox("box1", 5, scene);
				var box2 = BABYLON.Mesh.CreateBox("box2", 5, scene);
				box1.checkCollisions = box2.checkCollisions = true;
				box1.position.y = box2.position.y = 2.5;
				box1.position.x = 15;
				box2.position.x = -15;
				shadowMap.renderList.push(box1);
				shadowMap.renderList.push(box2);
				var boxMat = new BABYLON.StandardMaterial("boxmat", scene);
				boxMat.diffuseTexture = new BABYLON.Texture("textures/crate.png", scene, false);
				box1.material = box2.material = boxMat;
			*/
	// ##############################################
	return scene;
};
		
